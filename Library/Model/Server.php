<?php
/**
 * Fantasy Forest
 * minecraft user manage
 * Author: Sendya <18x@loacg.com>
 */
namespace Model;

class Server
{
    public static function GetServerInfo($host, $port = 25565, $timeout = 2)
    {
    	$Socket = Socket_Create( AF_INET, SOCK_STREAM, SOL_TCP );
    
    	Socket_Set_Option( $Socket, SOL_SOCKET, SO_SNDTIMEO, array( 'sec' => (int)$timeout, 'usec' => 0 ) );
    	Socket_Set_Option( $Socket, SOL_SOCKET, SO_RCVTIMEO, array( 'sec' => (int)$timeout, 'usec' => 0 ) );
    
    	if( $Socket === false || @Socket_Connect( $Socket, $host, (int)$port ) === false ) {
    		return false;
    	}
    
    	Socket_Send( $Socket, "\xFE\x01", 2, 0 );
    	$Len = Socket_Recv( $Socket, $Data, 512, 0 );
    	Socket_Close( $Socket );
    
    	if( $Len < 4 || $Data[ 0 ] !== "\xFF" ) {
    		return false;
    	}
    
    	$Data = SubStr( $Data, 3 );
    	$Data = iconv( 'UTF-16BE', 'UTF-8', $Data );
    
    	if( $Data[ 1 ] === "\xA7" && $Data[ 2 ] === "\x31" ) {
    		$Data = Explode( "\x00", $Data );
    		return Array(
    			'HostName'   => $Data[ 3 ],
    			'Players'    => IntVal( $Data[ 4 ] ),
    			'MaxPlayers' => IntVal( $Data[ 5 ] ),
    			'Protocol'   => IntVal( $Data[ 1 ] ),
    			'Version'    => $Data[ 2 ],
    		);
    	}
    
    	$Data = Explode( "\xA7", $Data );
    	return Array(
    		'HostName'   => SubStr( $Data[ 0 ], 0, -1 ),
    		'Players'    => isset( $Data[ 1 ] ) ? IntVal( $Data[ 1 ] ) : 0,
    		'MaxPlayers' => isset( $Data[ 2 ] ) ? IntVal( $Data[ 2 ] ) : 0,
    		'Protocol'   => 0,
    		'Version'    => '1.7.10',
    	);
    }
}