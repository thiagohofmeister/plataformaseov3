<pre>
<?php
$token = $_GET['token'];

if ($token == 'a5f55ae5bd9674dd11b680666248acd1') {
    shell_exec("rm -rf ../.git/refs/remotes/origin");
    shell_exec("rm -rf ../.git/logs/refs/heads/staging/HEAD");
    shell_exec("rm -rf ../.git/logs/refs/heads/staging");
    shell_exec("rm -rf ../.git/logs/HEAD");

    shell_exec("git checkout .");
    $exec = shell_exec("git pull origin staging 2>&1");
    echo $exec;

    $textoLog = PHP_EOL."Data: ".date(d."/".m."/".Y." - ".H.":".i.":".s);
    $textoLog .= PHP_EOL.$exec;

    $arquivoLog = fopen('log_staging.txt', 'a+');
    fwrite($arquivoLog, $textoLog);
    fclose($arquivoLog);
}
?>
</pre>