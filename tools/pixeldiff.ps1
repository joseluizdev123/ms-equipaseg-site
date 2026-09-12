<#
.SYNOPSIS
  Diff numérico entre o PNG exportado do Figma e o screenshot do site.
.DESCRIPTION
  Mede, numa região:
  - % estrita: pixels cuja cor difere além da tolerância;
  - % real: descarta divergências de antialiasing (a cor existe na outra imagem a até -Radius px);
  - deslocamento (dx, dy) que melhor casa o site com o Figma;
  - faixas de linhas onde a divergência real se concentra.
  Com -Out, grava imagem empilhada Figma / Site / Diff (vermelho = real, laranja claro = antialiasing).
.EXAMPLE
  powershell -ExecutionPolicy Bypass -File tools/pixeldiff.ps1 -Figma _ref/page-full.png -Site _ref/site-full.png -Y 0 -H 72 -Out _ref/diff/header.png
#>
param(
  [Parameter(Mandatory = $true)] [string] $Figma,
  [Parameter(Mandatory = $true)] [string] $Site,
  [int] $X = 0,
  [int] $Y = 0,
  [int] $W = 0,
  [int] $H = 0,
  [int] $Tolerance = 32,
  [int] $Radius = 1,
  [int] $MaxShift = 6,
  [string] $Out = ''
)

$ErrorActionPreference = 'Stop'
Add-Type -AssemblyName System.Drawing

if (-not ('PixelDiff2' -as [type])) {
  Add-Type -ReferencedAssemblies System.Drawing -TypeDefinition @'
using System;
using System.Drawing;
using System.Drawing.Imaging;
using System.IO;
using System.Runtime.InteropServices;
using System.Text;

public static class PixelDiff2
{
    private static int[] Load(string path, out int width, out int height)
    {
        using (var src = new Bitmap(path))
        {
            width = src.Width;
            height = src.Height;
            var rect = new Rectangle(0, 0, width, height);
            using (var bmp = src.Clone(rect, PixelFormat.Format32bppArgb))
            {
                var data = bmp.LockBits(rect, ImageLockMode.ReadOnly, PixelFormat.Format32bppArgb);
                var pixels = new int[width * height];
                for (int row = 0; row < height; row++)
                    Marshal.Copy(IntPtr.Add(data.Scan0, row * data.Stride), pixels, row * width, width);
                bmp.UnlockBits(data);
                for (int k = 0; k < pixels.Length; k++) pixels[k] = Opaque(pixels[k]);
                return pixels;
            }
        }
    }

    // Compõe sobre branco (o frame do Figma tem fundo branco).
    private static int Opaque(int argb)
    {
        int a = (argb >> 24) & 255;
        if (a == 255) return argb;
        int r = (((argb >> 16) & 255) * a + 255 * (255 - a)) / 255;
        int g = (((argb >> 8) & 255) * a + 255 * (255 - a)) / 255;
        int b = ((argb & 255) * a + 255 * (255 - a)) / 255;
        return unchecked((int)0xFF000000) | (r << 16) | (g << 8) | b;
    }

    private static int Delta(int p, int q)
    {
        int dr = Math.Abs(((p >> 16) & 255) - ((q >> 16) & 255));
        int dg = Math.Abs(((p >> 8) & 255) - ((q >> 8) & 255));
        int db = Math.Abs((p & 255) - (q & 255));
        return Math.Max(dr, Math.Max(dg, db));
    }

    // A cor aparece na imagem a até r px de (cx, cy)?
    private static bool Near(int[] img, int iw, int ih, int cx, int cy, int color, int r, int tol)
    {
        for (int dy = -r; dy <= r; dy++)
        {
            int yy = cy + dy;
            if (yy < 0 || yy >= ih) continue;
            for (int dx = -r; dx <= r; dx++)
            {
                int xx = cx + dx;
                if (xx < 0 || xx >= iw) continue;
                if (Delta(color, img[yy * iw + xx]) <= tol) return true;
            }
        }
        return false;
    }

    public static string Run(string figmaPath, string sitePath, int x, int y, int w, int h, int tol, int radius, int maxShift, string outPath)
    {
        int fw, fh, sw, sh;
        var f = Load(figmaPath, out fw, out fh);
        var s = Load(sitePath, out sw, out sh);
        int maxW = Math.Min(fw, sw) - x;
        int maxH = Math.Min(fh, sh) - y;
        if (w <= 0 || w > maxW) w = maxW;
        if (h <= 0 || h > maxH) h = maxH;

        var sb = new StringBuilder();
        sb.AppendFormat("imagens: figma {0}x{1}, site {2}x{3}\n", fw, fh, sw, sh);
        sb.AppendFormat("regiao: x={0} y={1} w={2} h={3}\n", x, y, w, h);

        long strict = 0, real = 0;
        var rowReal = new int[h];
        var mask = new byte[w * h]; // 0 igual, 1 antialiasing, 2 real
        for (int j = 0; j < h; j++)
            for (int i = 0; i < w; i++)
            {
                int ax = x + i, ay = y + j;
                int fp = f[ay * fw + ax], sp = s[ay * sw + ax];
                if (Delta(fp, sp) <= tol) continue;
                strict++;
                bool aa = Near(s, sw, sh, ax, ay, fp, radius, tol) && Near(f, fw, fh, ax, ay, sp, radius, tol);
                if (aa) { mask[j * w + i] = 1; continue; }
                mask[j * w + i] = 2;
                real++;
                rowReal[j]++;
            }

        long total = (long)w * h;
        sb.AppendFormat("divergencia estrita (tol {0}): {1} px = {2:F2}%\n", tol, strict, 100.0 * strict / total);
        sb.AppendFormat("divergencia real (sem antialiasing, raio {0}): {1} px = {2:F3}%\n", radius, real, 100.0 * real / total);

        // Deslocamento: compara f[p] com s[p + d]. d positivo = conteúdo do site mais à direita/abaixo.
        Func<int, int, double> meanError = (dx, dy) =>
        {
            long sum = 0, n = 0;
            for (int j = maxShift; j < h - maxShift; j += 2)
                for (int i = maxShift; i < w - maxShift; i += 2)
                {
                    int sy = y + j + dy, sx = x + i + dx;
                    if (sy < 0 || sy >= sh || sx < 0 || sx >= sw) continue;
                    sum += Delta(f[(y + j) * fw + x + i], s[sy * sw + sx]);
                    n++;
                }
            return n > 0 ? (double)sum / n : double.MaxValue;
        };

        double zero = meanError(0, 0);
        double best = zero;
        int bestDx = 0, bestDy = 0;
        for (int dy = -maxShift; dy <= maxShift; dy++)
            for (int dx = -maxShift; dx <= maxShift; dx++)
            {
                if (dx == 0 && dy == 0) continue;
                double e = meanError(dx, dy);
                if (e < best - 0.05) { best = e; bestDx = dx; bestDy = dy; }
            }
        sb.AppendFormat("erro medio sem deslocamento: {0:F2} | melhor deslocamento do site: dx={1} dy={2} (erro {3:F2})\n", zero, bestDx, bestDy, best);

        int bands = 0, start = -1;
        for (int j = 0; j <= h; j++)
        {
            bool bad = j < h && rowReal[j] > 0;
            if (bad && start < 0) start = j;
            if (!bad && start >= 0)
            {
                int count = 0, minX = int.MaxValue, maxX = -1;
                for (int jj = start; jj < j; jj++)
                    for (int i = 0; i < w; i++)
                        if (mask[jj * w + i] == 2) { count++; if (i < minX) minX = i; if (i > maxX) maxX = i; }
                if (bands < 25) sb.AppendFormat("  divergencia real: y {0}-{1}, x {2}-{3}, {4} px\n", y + start, y + j - 1, x + minX, x + maxX, count);
                bands++;
                start = -1;
            }
        }
        if (bands > 25) sb.AppendFormat("  (+{0} faixas)\n", bands - 25);

        if (!string.IsNullOrEmpty(outPath))
        {
            const int gap = 6;
            int height = h * 3 + gap * 2;
            using (var img = new Bitmap(w, height, PixelFormat.Format32bppArgb))
            {
                var rect = new Rectangle(0, 0, w, height);
                var data = img.LockBits(rect, ImageLockMode.WriteOnly, PixelFormat.Format32bppArgb);
                var buf = new int[w * height];
                for (int k = 0; k < buf.Length; k++) buf[k] = unchecked((int)0xFFFF00FF);
                for (int j = 0; j < h; j++)
                    for (int i = 0; i < w; i++)
                    {
                        int fp = f[(y + j) * fw + x + i];
                        int sp = s[(y + j) * sw + x + i];
                        buf[j * w + i] = fp;
                        buf[(h + gap + j) * w + i] = sp;
                        int lum = (((fp >> 16) & 255) * 3 + ((fp >> 8) & 255) * 6 + (fp & 255)) / 10;
                        int gray = 200 + lum / 5;
                        int m = mask[j * w + i];
                        buf[(2 * h + 2 * gap + j) * w + i] = m == 2 ? unchecked((int)0xFFFF0000)
                            : m == 1 ? unchecked((int)0xFFFFD2A0)
                            : unchecked((int)0xFF000000) | (gray << 16) | (gray << 8) | gray;
                    }
                Marshal.Copy(buf, 0, data.Scan0, buf.Length);
                img.UnlockBits(data);
                Directory.CreateDirectory(Path.GetDirectoryName(outPath));
                img.Save(outPath, ImageFormat.Png);
            }
            sb.AppendFormat("comparativo: {0}\n", outPath);
        }
        return sb.ToString();
    }
}
'@
}

$figmaPath = (Resolve-Path $Figma).Path
$sitePath = (Resolve-Path $Site).Path
$outPath = if ($Out) { $ExecutionContext.SessionState.Path.GetUnresolvedProviderPathFromPSPath($Out) } else { '' }
[PixelDiff2]::Run($figmaPath, $sitePath, $X, $Y, $W, $H, $Tolerance, $Radius, $MaxShift, $outPath)
