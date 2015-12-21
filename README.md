mcSkin Panel
====================

没什么好说的..


Request URI
```
	/Auth/login  

	/Auth/register  

	/Auth/check (登录器检查是否登录)  

	/Server (取得服务器信息,在线用户,最大人数)  
	
```

/Skin/GameName.json (游戏昵称不区分大小写)  
```
{
  "player_name": {字符串，大小写正确的玩家名},
  "last_update": {整数，玩家最后一次修改个人信息的时间，UNIX时间戳},
  "model_preference": {字符串数组，按顺序存储玩家偏好的人物模型名称},
  "skins": {人物模型到对应皮肤UID的字典}
  "cape": {披风的UID}
}
```

完整返回实例  
```
{
  "player_name": "XiaoMing",
  "last_update": 1416300800,
  "model_preference": ["slim","default"],
  "skins": {
    "slim": "67cbc70720c4666e9a12384d041313c7bb9154630d7647eb1e8fba0c461275c6",
    "default": "6d342582972c5465b5771033ccc19f847a340b76d6131129666299eb2d6ce66e"
  }
  "cape": "970a71c6a4fc81e83ae22c181703558d9346e0566390f06fb93d09fcc9783799"
}
```
 
获取皮肤/材质文件  
```
/textures/{材质文件唯一标识符}
```

例如
```
http://domain.com/textures/6d342582972c5465b5771033ccc19f847a340b76d6131129666299eb2d6ce66e
```
返回http头信息为 image/png 的图像数据  


请求失败或找不到该用户时返回值
```
{
  "errno": {整数，错误代号},
  "msg": {字符串，人类可读的信息}
}
```

例
```
{
  "errno": 404,
  "msg": "not found"
}
```