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
if (Test-Path $outPath) { Remove-Item $outPath -Force }

# Perfil separado: não interfere no Chrome aberto do usuário.
$profileDir = Join-Path $env:TEMP 'mse-headless-profile'
$chromeArgs = @(
  '--headless=new',
  '--disable-gpu',
  '--hide-scrollbars',
  '--no-first-run',
  '--force-device-scale-factor=1',
  "--user-data-dir=`"$profileDir`"",
  "--window-size=$Width,$Height",
  '--virtual-time-budget=8000',
  "--screenshot=`"$outPath`"",
  $Url
)
Start-Process -FilePath $browser -ArgumentList $chromeArgs -Wait -NoNewWindow
if (-not (Test-Path $outPath)) { throw "Screenshot não gerado: $outPath" }
"ok: $outPath ($browser)"
