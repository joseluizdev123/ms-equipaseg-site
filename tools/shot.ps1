<#
.SYNOPSIS
  Screenshot headless do site na largura do frame do Figma, para o diff numérico.
.EXAMPLE
  powershell -ExecutionPolicy Bypass -File tools/shot.ps1 -Out _ref/site-full.png -Height 5837
#>
param(
  [string] $Url = 'http://localhost:5500/',
  [string] $Out = '_ref/site-full.png',
  [int] $Width = 1440,
  [int] $Height = 5837
)

$ErrorActionPreference = 'Stop'

$browser = @(
  (Join-Path $env:ProgramFiles 'Google\Chrome\Application\chrome.exe'),
  (Join-Path ${env:ProgramFiles(x86)} 'Google\Chrome\Application\chrome.exe'),
  (Join-Path $env:LOCALAPPDATA 'Google\Chrome\Application\chrome.exe'),
  (Join-Path ${env:ProgramFiles(x86)} 'Microsoft\Edge\Application\msedge.exe')
) | Where-Object { Test-Path $_ } | Select-Object -First 1
if (-not $browser) { throw 'Chrome ou Edge não encontrado.' }

$outPath = $ExecutionContext.SessionState.Path.GetUnresolvedProviderPathFromPSPath($Out)
New-Item -ItemType Directory -Force (Split-Path $outPath) | Out-Null

# Perfil separado: não interfere no Chrome aberto do usuário. O perfil é fixo porque guarda as fontes
# do Google em cache: com um perfil novo a cada execução, a Exo às vezes não chegava a tempo e o PNG
# saía com outra fonte, sem erro nenhum.
$profileDir = Join-Path $env:TEMP 'mse-headless-profile'
$tmpPath = [IO.Path]::ChangeExtension($outPath, ".$PID.tmp.png")
$chromeArgs = @(
  '--headless=new',
  '--disable-gpu',
  '--hide-scrollbars',
  # Carrossel parado no primeiro card: o JS só anda sozinho para quem não pediu menos movimento.
  '--force-prefers-reduced-motion',
  '--no-first-run',
  '--force-device-scale-factor=1',
  "--user-data-dir=`"$profileDir`"",
  "--window-size=$Width,$Height",
  '--virtual-time-budget=8000',
  "--screenshot=`"$tmpPath`"",
  $Url
)

# Um screenshot por vez entre todos os chats: com dois Chrome no mesmo perfil, o segundo sai sem gravar.
$trava = New-Object System.Threading.Mutex($false, 'mse-headless-shot')
try { $pegou = $trava.WaitOne([TimeSpan]::FromMinutes(5)) } catch [System.Threading.AbandonedMutexException] { $pegou = $true }
if (-not $pegou) { throw 'Outro screenshot está demorando mais de 5 minutos; tente de novo.' }
try {
  # Perfil ainda sem cache: uma rodada antes, só para baixar as fontes.
  if (-not (Test-Path (Join-Path $profileDir 'Default'))) {
    Start-Process -FilePath $browser -ArgumentList $chromeArgs -Wait -NoNewWindow
    Remove-Item $tmpPath -Force -ErrorAction SilentlyContinue
  }
  Start-Process -FilePath $browser -ArgumentList $chromeArgs -Wait -NoNewWindow
  if (-not (Test-Path $tmpPath)) { throw "Screenshot não gerado: $outPath" }
  # Só agora troca o PNG antigo pelo novo: se o Chrome falhar, o anterior continua lá.
  Move-Item -Force $tmpPath $outPath
} finally {
  $trava.ReleaseMutex()
  $trava.Dispose()
}
"ok: $outPath ($browser)"
