<?php

class ldap
{
	private $ldap_server;
	private $ldap_port;
	public function  __construct($host,$port)
	{
		$this->ldap_server=$host;
		$this->ldap_port=$port;
	}
	public function validate($user,$passwd)
	{
		$ldapconn=ldap_connect($this->ldap_server,$this->ldap_port);
		if (!$ldapconn)
			throw new Exception("Could not connect ldap server: ".ldap_err2str(ldap_errno($ldapconn)));
		ldap_set_option($ldapconn, LDAP_OPT_NETWORK_TIMEOUT, 1);
		ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION,3);
		ldap_set_option($ldapconn, LDAP_OPT_REFERRALS,0);
		$ldapbind = ldap_bind($ldapconn, $user, $passwd);
		if (!$ldapbind)
			throw new Exception("Username and password not match: ".ldap_err2str(ldap_errno($ldapconn)));
		$ldapbind = ldap_unbind($ldapconn);
		if (!$ldapbind)
			throw new Exception("unbind ldap server fail: ".ldap_error($ldapconn));
		
		return "ok";
	}
}
?>