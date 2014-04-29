<?php
/**
 * 美品网加密解密
 * @author wubaiqing <wubaiqing@vip.qq.com>
 * @copyright Copyright (c) 2014 美品网
 * @since 1.0
 */
class Des
{
	/**
	 * @var string 加密解密字符串附加key
	 */
	private static $key = "wubaiqing-meipin-20140427";
	
	/**
	 * 加密字符串
	 * @param mixed $encrypt
	 * @return string
	 */
	public static function encrypt($encrypt)
	{
		$encrypt = self::pkcs5_pad($encrypt);
		$iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_DES, MCRYPT_MODE_ECB), MCRYPT_RAND);
		$passcrypt = @mcrypt_encrypt(MCRYPT_DES, self::$key, $encrypt, MCRYPT_MODE_ECB, $iv);
		return bin2hex($passcrypt);
	}

	/**
	 * 解密字符串
	 * @param string $decrypt 加密字符串
	 * @return string
	 */
	public static function decrypt($decrypt)
	{
		$decoded = pack("H*", $decrypt);
		$iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_DES, MCRYPT_MODE_ECB), MCRYPT_RAND);
		$decrypted = @mcrypt_decrypt(MCRYPT_DES,self::$key, $decoded, MCRYPT_MODE_ECB, $iv);
		return self::pkcs5_unpad($decrypted);
	}

	/**
	 * 解除填充
	 * @param string $text 字符串
	 * @return string
	 */
	public static function pkcs5_unpad($text)
	{
		$pad = ord($text{strlen($text)-1});
		if ($pad > strlen($text)) return $text;
		if (strspn($text, chr($pad), strlen($text) - $pad) != $pad) return $text;
		return substr($text, 0, -1 * $pad);
	}

	/**
	 * 填充字符
	 * @param string $text 字符串
	 * @return string
	 */
	public static function pkcs5_pad($text)
	{
		$len = strlen($text);
		$mod = $len % 8;
		$pad = 8 - $mod;
		return $text.str_repeat(chr($pad),$pad);
	}
}


