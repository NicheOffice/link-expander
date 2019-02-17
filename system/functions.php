<?php
function url_get_contents($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36 Edge/12.10240');
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}

function unshortenUrl($url)
{
    $ch = curl_init($url);
    curl_setopt_array($ch, array(
        CURLOPT_FOLLOWLOCATION => TRUE,
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_SSL_VERIFYHOST => FALSE,
        CURLOPT_SSL_VERIFYPEER => FALSE,
    ));
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36 Edge/12.10240');
    curl_exec($ch);
    $url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
    curl_close($ch);
    return $url;
}

function checkSafety($url)
{
    $data = url_get_contents('http://www.expandurl.net/expand?url=' . $url);
    preg_match('@<span class="label label-success">(.*?)</span>@si', $data, $match);
    return $match[1];
}

function getData($url, $apiKey)
{
    $data['shortUrl'] = $url;
    $data['longUrl'] = unshortenUrl($url);
    $pageContent = url_get_contents($data['longUrl']);
    if (preg_match_all('/<title>(.+)<\/title>/', $pageContent, $match)) {
        $data['title'] = $match[1][0];
    }
    if (preg_match_all('/name=(\'|")description(\'|") content=(\'|")(.*?)(\'|")/', $pageContent, $match)) {
        $data['description'] = $match[4][0];
    }
    if (preg_match_all('/name=(\'|")keywords(\'|") content=(\'|")(.*?)(\'|")/', $pageContent, $match)) {
        $data['keywords'] = $match[4][0];
    }
    if (preg_match_all('/property=(\'|")og:image(\'|") content=(\'|")(.*?)(\'|")/', $pageContent, $match)) {
        $data['image'] = $match[4][0];
    }
    $data['safety'] = checkSafety($data['longUrl']);
    if ($data['safety'] == 'OK') {
        $data['tagClass'] = 'success';
    } else {
        $data['tagClass'] = 'danger';
    }
    $data['screenshot'] = 'http://api.page2images.com/directlink?p2i_url=' . $data['longUrl'] . '&p2i_device=6&p2i_screen=1024x768&p2i_size=300x300&p2i_imageformat=jpg&p2i_key=' . $apiKey;
    return $data;
}

function csrfToken()
{
    if (defined('PHP_MAJOR_VERSION') && PHP_MAJOR_VERSION > 5) {
        return bin2hex(random_bytes(32));
    } else {
        if (function_exists('mcrypt_create_iv')) {
            return bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
        } else {
            return bin2hex(openssl_random_pseudo_bytes(32));
        }
    }
}