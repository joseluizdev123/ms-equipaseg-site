<#
.SYNOPSIS
  Mede onde há "tinta" (pixels diferentes do fundo) numa região. Serve para comparar posições
  de texto e blocos entre o PNG do Figma e o screenshot do site.
.DESCRIPTION
  Cada consulta tem o formato "rótulo|modo|x0|x1|y0|y1|fundoHex|tolerância|vãoMínimo".
  modo rows: faixas verticais (ex.: linhas de texto). modo cols: faixas horizontais (ex.: palavras,
  itens de menu). Vãos menores que vãoMínimo são fundidos na mesma faixa.
.EXAMPLE
  powershell -ExecutionPolicy Bypass -File tools/extents.ps1 -Images _ref/page-full.png,_ref/site-full.png -Queries 'menu|cols|250|1100|24|48|0D0D0B|40|12'
#>
param(
  [Parameter(Mandatory = $true)] [string[]] $Images,
  [Parameter(Mandatory = $true)] [string[]] $Queries
)

$ErrorActionPreference = 'Stop'
Add-Type -AssemblyName System.Drawing

if (-not ('InkExtents' -as [type])) {
  Add-Type -ReferencedAssemblies System.Drawing -TypeDefinition @'
using System;
using System.Drawing;
using System.Drawing.Imaging;
using System.Runtime.InteropServices;
using System.Text;

public class InkExtents
{
    private readonly int[] px;
    private readonly int width;
    private readonly int height;

    public InkExtents(string path)
    {
        using (var src = new Bitmap(path))
        {
            width = src.Width;
            height = src.Height;
            var rect = new Rectangle(0, 0, width, height);
            using (var bmp = src.Clone(rect, PixelFormat.Format32bppArgb))
            {
                var data = bmp.LockBits(rect, ImageLockMode.ReadOnly, PixelFormat.Format32bppArgb);
                px = new int[width * height];
                for (int r = 0; r < height; r++)
                    Marshal.Copy(IntPtr.Add(data.Scan0, r * data.Stride), px, r * width, width);
                bmp.UnlockBits(data);
            }
        }
    }

    public string Query(bool rows, int x0, int x1, int y0, int y1, int bg, int tol, int minGap)
    {
        x1 = Math.Min(x1, width - 1);
        y1 = Math.Min(y1, height - 1);
        int br = (bg >> 16) & 255, bgg = (bg >> 8) & 255, bb = bg & 255;
        int n = rows ? (y1 - y0 + 1) : (x1 - x0 + 1);
        var ink = new bool[n];
        for (int y = y0; y <= y1; y++)
            for (int x = x0; x <= x1; x++)
            {
                int p = px[y * width + x];
                int d = Math.Max(Math.Abs(((p >> 16) & 255) - br),
                        Math.Max(Math.Abs(((p >> 8) & 255) - bgg), Math.Abs((p & 255) - bb)));
                if (d > tol) ink[rows ? y - y0 : x - x0] = true;
            }

        var sb = new StringBuilder();
        int offset = rows ? y0 : x0;
        int start = -1, last = -1;
        for (int i = 0; i < n; i++)
        {
            if (!ink[i]) continue;
            if (start < 0) start = i;
            else if (i - last - 1 >= minGap)
            {
                sb.AppendFormat("{0}-{1} ({2}px)  ", start + offset, last + offset, last - start + 1);
                start = i;
            }
            last = i;
        }
        if (start >= 0) sb.AppendFormat("{0}-{1} ({2}px)", start + offset, last + offset, last - start + 1);
        return sb.Length > 0 ? sb.ToString() : "(sem tinta)";
    }
}
'@
}

$loaded = @{}
foreach ($image in $Images) {
  $loaded[$image] = New-Object InkExtents ((Resolve-Path $image).Path)
}

foreach ($query in $Queries) {
  $p = $query.Split('|')
  "[{0}] {1} x{2}-{3} y{4}-{5}" -f $p[0], $p[1], $p[2], $p[3], $p[4], $p[5]
  foreach ($image in $Images) {
    $result = $loaded[$image].Query($p[1] -eq 'rows', [int]$p[2], [int]$p[3], [int]$p[4], [int]$p[5], [Convert]::ToInt32($p[6], 16), [int]$p[7], [int]$p[8])
    "  {0,-22} {1}" -f (Split-Path $image -Leaf), $result
  }
}
