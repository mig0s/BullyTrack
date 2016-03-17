<?
function Redirect($url, $permanent = false)
{
    if (headers_sent() === false)
    {
    	header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
    }

    exit();
}

Redirect('http://mail.yandex.com/for/bullytrack.ga', false);

?>
