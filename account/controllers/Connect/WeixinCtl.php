<?php
/*   __________________________________________________
    |  zeroframework  1.8.8                          |
    |__________________________________________________|
*/
 goto EwOYw; n4_jR: die("\x4e\157\x20\x50\x65\162\x6d\x69\163\x73\x69\157\x6e"); goto TFPXV; kcTbF: class WxErrorCode { public static $OK = 0; public static $IllegalAesKey = -41001; public static $IllegalIv = -41002; public static $IllegalBuffer = -41003; public static $DecodeBase64Error = -41004; } goto i5Hbq; TFPXV: t9j6M: goto LjVLb; LjVLb: class Connect_WeixinCtl extends Zero_AppController implements Connect_Interface { public $options = null; public $api = null; public $redirectUrl = null; public function __construct(&$H9r7C, $P5DKc, $g8bIB) { goto Rbqyo; Rbqyo: parent::__construct($H9r7C, $P5DKc, $g8bIB); goto jVQts; fc7DH: cZj_Z: goto SiDYJ; Usw6H: LT8DO: goto ii3PS; CMpdp: $this->options = array("\141\x70\x70\151\144" => Base_ConfigModel::getConfig("\x77\145\x63\x68\x61\x74\137\x78\x63\170\137\x61\x70\x70\137\x69\144"), "\x61\x70\160\x73\145\143\162\x65\164" => Base_ConfigModel::getConfig("\x77\145\143\150\141\164\x5f\170\143\x78\137\x61\x70\160\x5f\163\145\143\162\145\164"), "\x63\141\x63\x68\x65\137\x6e\x61\155\145" => "\x77\x65\143\150\141\164"); goto fc7DH; g2WLR: $this->options = array("\x61\160\160\x69\144" => Base_ConfigModel::getConfig("\167\145\151\170\x69\156\x5f\141\160\160\x5f\151\x64"), "\141\160\160\x73\145\143\162\145\164" => Base_ConfigModel::getConfig("\x77\145\x69\x78\151\156\x5f\x61\x70\160\x5f\x6b\x65\x79"), "\x63\141\x63\x68\x65\x5f\156\141\155\x65" => "\x77\x65\x63\150\x61\x74"); goto DqaYS; N2ZWM: L8XNE: goto CMpdp; ebx3Y: goto cZj_Z; goto N2ZWM; SiDYJ: $this->api = new Zero_Api_Wechat($this->options); goto aQWgc; MQ6dB: VC930: goto ebx3Y; uKk1Z: if (Zero_Utils_Device::isWeixin() || "\155\x70" == s("\x66\x6c\x61\x67")) { goto LT8DO; } goto g2WLR; jVQts: if ("\152\163\x63\157\144\145\x32\x73\145\163\x73\151\157\156" == $P5DKc) { goto L8XNE; } goto uKk1Z; ii3PS: $this->options = array("\x61\x70\x70\151\x64" => Base_ConfigModel::getConfig("\167\145\x63\x68\141\164\x5f\x61\160\160\137\151\x64"), "\141\x70\x70\x73\x65\x63\162\145\164" => Base_ConfigModel::getConfig("\x77\x65\143\150\141\x74\137\141\x70\160\137\163\145\x63\162\145\164"), "\143\141\x63\150\x65\x5f\x6e\x61\155\145" => "\167\x65\x63\x68\x61\x74"); goto MQ6dB; DqaYS: goto VC930; goto Usw6H; aQWgc: } public function select() { } public function login() { goto yRyd5; t_7HX: $l50Le = new User_BindConnectModel(); goto GfYSD; nchBP: $V29uM = $l50Le->find($prX2w); goto Y1sVg; Fhevr: location_to($y4spJ); goto xQ7pA; l1WMy: RP0tp: goto FDVni; dqGIz: $LrD3P = sprintf("\45\x73\77\x63\164\x6c\x3d\103\x6f\x6e\156\145\x63\x74\x5f\x57\x65\x69\x78\151\x6e\x26\155\145\x74\x3d\x6d\x70\103\141\x6c\x6c\142\141\x63\153\46\146\x6c\x61\x67\x3d\155\160\45\163", Zero_Registry::get("\165\162\154"), LoginModel::callbackStr(false)); goto CqLrB; CqLrB: TG1sb: goto FOa0p; yRyd5: if (!Zero_Perm::checkUserPerm()) { goto L0dhl; } goto ji52_; ji52_: $YKJ9A = Zero_Perm::getUserId(); goto t_7HX; ulTjb: if ("\155\x70" == s("\146\x6c\x61\147")) { goto G72qm; } goto ijHew; GfYSD: $prX2w = array("\142\x69\156\x64\x5f\x74\171\160\145" => User_BindConnectModel::WEIXIN, "\165\163\x65\162\137\151\x64" => $YKJ9A, "\x62\151\x6e\144\137\x61\x63\x74\151\x76\x65" => 1); goto nchBP; k5mS0: $y4spJ = $this->api->getOauthPcRedirect($LrD3P, "\61", "\163\156\163\x61\x70\151\x5f\x6c\157\x67\x69\x6e"); goto LdD5V; L20Wt: die; goto Kgqh3; NXfue: goto TG1sb; goto moe0i; moe0i: G72qm: goto dqGIz; b2mQs: L0dhl: goto ulTjb; FOa0p: $this->redirectUrl = $LrD3P; goto B0Rwz; R_6ge: location_to(urlh(Zero_Registry::get("\x69\x6e\x64\145\x78\137\x70\x61\147\145"), "\125\163\145\x72\137\101\143\143\x6f\x75\x6e\164", "\x69\156\144\x65\170")); goto L20Wt; Y1sVg: if (!$V29uM) { goto zhopD; } goto R_6ge; B0Rwz: if (Zero_Utils_Device::isWeixin() || "\155\x70" == s("\x66\154\141\147")) { goto RP0tp; } goto k5mS0; LdD5V: goto FfU6G; goto l1WMy; OnnAC: FfU6G: goto Fhevr; Kgqh3: zhopD: goto b2mQs; ijHew: $LrD3P = sprintf("\45\163\77\143\164\x6c\75\x43\157\156\156\145\143\x74\137\x57\145\151\x78\151\156\46\155\145\164\x3d\143\x61\x6c\x6c\x62\141\143\153\45\x73", Zero_Registry::get("\165\x72\x6c"), LoginModel::callbackStr(false)); goto NXfue; FDVni: $y4spJ = $this->api->getOauthRedirect($LrD3P, 1, "\x73\x6e\x73\x61\160\x69\137\x75\163\145\x72\x69\156\x66\157"); goto OnnAC; xQ7pA: } public function callback() { goto F0zB9; WZgBE: lHTf4: goto lsOn9; kzl8w: xyW2V: goto FhHQb; wyWNB: $data["\x62\x69\156\144\137\x63\151\x74\171"] = $WDqJN["\143\x69\164\171"]; goto iU9fg; Z9S30: $oPeFk = sprintf("\x25\163\137\x25\x73", "\167\145\x69\170\151\156", $WDqJN["\165\x6e\151\157\156\x69\144"]); goto TEcdy; rjZA5: GqmJv: goto godfI; R6vn0: $l50Le = new User_BindConnectModel(); goto QHsPc; TLM0Q: $msg = __("\xe6\243\200\346\265\213\347\xbb\221\345\xae\x9a\xe5\xa4\261\xe8\264\xa5"); goto uUh7h; xHQoq: $msg = "\x73\x75\x63\x63\x65\163\163"; goto FzNkG; M9573: $msg = $JOpS7; goto ufsJN; uuIDs: if (isset($WDqJN["\x75\x6e\x69\157\156\151\144"])) { goto lTLyc; } goto gXt4C; f_KrK: $msg = __("\350\x8e\xb7\xe5\217\226\164\157\x6b\145\156\345\244\xb1\350\xb4\xa5"); goto mR1U0; Vr2LO: $odsTb["\162\x65\x66\162\145\163\150\x5f\164\157\153\x65\156"]; goto ZrxR0; ufsJN: $this->redirect($JOpS7); goto LS4Gu; fc6ey: goto SoY_W; goto WZgBE; AqiTJ: $data = array(); goto xHQoq; MIaMi: if ($odsTb) { goto xyW2V; } goto f_KrK; FzNkG: $lp2wr = 200; goto ORO57; uUh7h: $lp2wr = 250; goto NS0dR; CND44: $odsTb["\x61\x63\143\145\x73\163\x5f\x74\x6f\153\145\x6e"]; goto kK3JA; LS4Gu: u5uvg: goto Zx7gW; JMLRo: Av9yj: goto JmFla; nDF4R: $YKJ9A = 0; goto iT3lo; GU2Ra: $data["\x62\x69\x6e\x64\137\165\x6e\x69\157\x6e\151\144"] = isset($WDqJN["\165\x6e\x69\x6f\156\x69\144"]) ? $WDqJN["\x75\156\151\157\x6e\x69\144"] : 0; goto IdzbJ; IdzbJ: $data["\142\151\156\144\x5f\x61\143\x63\x65\163\163\x5f\x74\x6f\153\x65\156"] = $odsTb["\x61\143\143\x65\163\x73\137\164\x6f\x6b\145\x6e"]; goto ENdmt; UDk6m: $odsTb["\165\156\151\x6f\156\151\x64"]; goto MIaMi; Zx7gW: hezY3: goto Oglp2; EQLnk: xhw38: goto M9573; BjybP: $data["\142\151\156\x64\137\x69\x64"] = $oPeFk; goto GEbdG; mR1U0: $lp2wr = 250; goto gdwox; ORO57: $ym6SM = false; goto qOAAl; ZS_zx: $msg = __("\350\xbf\x94\345\x9b\x9e\346\225\260\346\215\256\351\224\x99\350\257\257"); goto g65OK; zSgOf: $data["\x62\x69\x6e\144\x5f\x61\143\x74\151\166\145"] = 1; goto R6vn0; Oglp2: SoY_W: goto E1FIs; D2jMX: $data = array(); goto BjybP; Z4Lpj: $data["\142\151\156\144\137\x63\x6f\x75\156\164\162\171"] = $WDqJN["\x63\157\x75\156\x74\162\171"]; goto Ce63B; E1FIs: $this->render("\x6c\x6f\147\x69\156", $data, $msg, $lp2wr); goto Bm7Fs; gdwox: goto hezY3; goto kzl8w; GEbdG: $data["\142\151\x6e\144\x5f\164\x79\x70\145"] = User_BindConnectModel::WEIXIN; goto TxjlQ; htOPU: $data["\x62\x69\156\144\137\162\145\146\162\x65\163\150\x5f\164\157\x6b\145\x6e"] = $odsTb["\162\x65\146\x72\x65\163\150\137\164\x6f\153\x65\x6e"]; goto zSgOf; Ce63B: $data["\x62\x69\156\x64\137\x70\162\157\x76\151\156\143\x65"] = $WDqJN["\x70\162\x6f\x76\x69\x6e\x63\x65"]; goto wyWNB; lsOn9: $odsTb = $this->api->getOauthAccessToken($e5Ay1); goto CND44; ZrxR0: $odsTb["\x6f\160\145\x6e\x69\144"]; goto DIziH; F0zB9: $e5Ay1 = s("\x63\x6f\144\x65", null); goto AqiTJ; ENdmt: $data["\x62\x69\x6e\144\x5f\x65\x78\160\x69\x72\x65\163\137\x69\x6e"] = $odsTb["\x65\x78\160\151\x72\x65\x73\137\151\x6e"]; goto htOPU; i00NN: $data["\142\151\x6e\x64\x5f\156\x69\143\x6b\156\141\155\145"] = $WDqJN["\156\151\143\153\156\x61\155\x65"]; goto zYDVO; TEcdy: rSYz2: goto D2jMX; NS0dR: goto u5uvg; goto EQLnk; FhHQb: $WDqJN = $this->api->getOauthUserinfo($odsTb["\x61\x63\x63\145\x73\163\x5f\x74\157\153\x65\156"], $odsTb["\x6f\160\145\156\151\144"]); goto uuIDs; iU9fg: $data["\142\151\156\x64\137\157\x70\x65\156\151\x64"] = $WDqJN["\157\160\x65\x6e\151\144"]; goto GU2Ra; gXt4C: throw new Exception(__("\165\x6e\151\157\x6e\151\x64\x20\xe4\xb8\215\xe5\255\230\345\x9c\xa8")); goto c1WG5; Bx88Z: $data["\142\x69\156\144\137\147\x65\x6e\x64\145\162"] = $WDqJN["\163\145\x78"]; goto Z4Lpj; JmFla: $YKJ9A = Zero_Perm::getUserId(); goto rjZA5; DIziH: $odsTb["\x73\143\x6f\x70\x65"]; goto UDk6m; r1Dl5: lTLyc: goto Z9S30; Vs1u2: if ($JOpS7) { goto xhw38; } goto TLM0Q; QHsPc: $JOpS7 = $l50Le->checkBind($oPeFk, User_BindConnectModel::WEIXIN, $YKJ9A, $data); goto Vs1u2; kK3JA: $odsTb["\x65\x78\160\151\162\145\163\137\151\156"]; goto Vr2LO; iT3lo: goto GqmJv; goto JMLRo; c1WG5: goto rSYz2; goto r1Dl5; g65OK: $lp2wr = 250; goto fc6ey; TxjlQ: $data["\165\x73\145\x72\x5f\151\x64"] = $YKJ9A; goto i00NN; qOAAl: if (Zero_Perm::checkUserPerm()) { goto Av9yj; } goto nDF4R; zYDVO: $data["\142\x69\156\x64\x5f\151\x63\157\156"] = $WDqJN["\x68\x65\x61\x64\151\155\x67\165\162\154"]; goto Bx88Z; godfI: if ($e5Ay1) { goto lHTf4; } goto ZS_zx; Bm7Fs: } public function mpCallback() { goto kmwDv; kqFQ4: $YKJ9A = Zero_Perm::getUserId(); goto Yz4Zs; RCf_K: Message_TemplateModel::getInstance()->sendNoticeMsg($data["\165\x73\x65\162\137\151\x64"], 0, $lCtyQ, $XKzDw); goto MryiL; eUj4M: $JOpS7 = User_InfoModel::getInstance()->editAccount($YKJ9A, $gXoTn); goto DSqBK; uHHDy: goto AaSM4; goto ZD8tf; mctp0: if ($odsTb) { goto AlESv; } goto e4Nli; ckm6L: pZvwI: goto I1Pq_; C5blF: $msg = @$JOpS7; goto g3QF7; gEcjt: $YKJ9A = 0; goto tBpDd; e4Nli: $msg = __("\350\216\267\xe5\217\226\164\157\153\x65\156\345\xa4\xb1\xe8\264\xa5"); goto H3GXb; a5qJy: LLcIV: goto kqFQ4; lMgyc: goto aHh_S; goto FXjAE; zZ81a: $data["\x62\151\x6e\x64\137\x65\170\x70\x69\162\x65\x73\137\151\156"] = $odsTb["\x65\170\160\x69\x72\x65\163\137\x69\156"]; goto w9NTn; U4NgK: $gXoTn["\165\x73\x65\162\137\141\x76\x61\x74\x61\x72"] = $WDqJN["\x68\145\141\x64\x69\155\147\165\162\x6c"]; goto DJuum; g3QF7: $rtpff = new LoginModel(); goto LfTdv; slFW7: $gXoTn = array(); goto V8Vhy; MryiL: vp9ix: goto lMgyc; EzOmm: $lCtyQ = "\162\145\x67\151\x73\x74\162\x61\x74\151\x6f\156\55\157\146\x2d\167\x65\x6c\143\157\x6d\145\55\x69\156\146\x6f\162\155\x61\164\x69\157\x6e"; goto eK5Pq; CWvnj: $lp2wr = 250; goto wxJTq; r317r: $aR_D0 = User_InfoModel::getInstance()->register($oPeFk, rand(1000000000, 9999999999), null, null, null, false); goto eeGpm; bxxYr: $data["\x62\x69\156\x64\x5f\x70\162\x6f\x76\151\x6e\143\x65"] = $WDqJN["\160\x72\157\166\151\156\x63\145"]; goto fD5ho; fKtTk: $data["\x62\151\x6e\x64\137\151\144"] = $oPeFk; goto xbbNk; eXlTp: if ($YKJ9A) { goto XY965; } goto EmYeZ; DSqBK: $data = array(); goto fKtTk; LyjhE: if (!$YKJ9A) { goto vp9ix; } goto slFW7; wFUkW: if (!Base_ConfigModel::ifStoreFx()) { goto VXAsQ; } goto VwsG3; qlc0G: $data["\142\x69\156\x64\137\x69\143\x6f\x6e"] = $WDqJN["\150\x65\x61\144\151\x6d\147\x75\x72\x6c"]; goto i8iS3; zZHH_: $JOpS7 = $l50Le->checkBind($oPeFk, User_BindConnectModel::WEIXIN, $YKJ9A, $data, true); goto wAVfL; EpYvk: $data["\x62\151\156\x64\x5f\141\x63\x74\x69\166\x65"] = 1; goto CwamJ; xEcK2: User_BaseModel::addSourceUserId($data["\x75\163\145\x72\137\151\x64"]); goto Yy_D1; wZEHL: XY965: goto C5blF; y2M5n: $ym6SM = false; goto x66Wz; eeGpm: $YKJ9A = $aR_D0["\165\x73\x65\x72\137\x69\x64"]; goto LyjhE; rB7PY: LoginModel::checkCallback(); goto ckm6L; V8Vhy: $gXoTn["\165\x73\145\162\137\156\151\x63\153\156\x61\x6d\145"] = $WDqJN["\156\x69\x63\153\x6e\x61\155\x65"]; goto U4NgK; H3GXb: $lp2wr = 250; goto uHHDy; mc6e3: aHh_S: goto MYHHn; w9NTn: $data["\x62\151\156\x64\137\162\145\146\x72\x65\163\x68\x5f\x74\157\x6b\x65\156"] = $odsTb["\162\x65\146\162\145\163\x68\137\x74\x6f\x6b\x65\x6e"]; goto EpYvk; JLmoW: $data["\x62\151\x6e\x64\137\x61\x63\x63\x65\163\163\137\x74\157\x6b\145\156"] = $odsTb["\x61\x63\x63\x65\163\x73\x5f\x74\x6f\153\145\156"]; goto zZ81a; Yz4Zs: E6YRO: goto V28od; BP7QG: goto E6YRO; goto a5qJy; CN2bE: $YKJ9A = $aR_D0["\x75\x73\x65\162\x5f\x69\144"]; goto mc6e3; wAVfL: if (!Base_ConfigModel::ifPlantformFx()) { goto mib1t; } goto xEcK2; tBpDd: if (!$e5Ay1) { goto y8Oac; } goto JZf3b; GOYTt: $lp2wr = 200; goto y2M5n; nwri1: $data = array(); goto Q6sC9; LfTdv: $data = $rtpff->doLogin($YKJ9A); goto rB7PY; vg58T: if ($aR_D0 = User_BaseModel::getInstance()->getByAccount($oPeFk)) { goto nQObc; } goto r317r; fD5ho: $data["\x62\x69\156\144\137\x63\151\164\171"] = $WDqJN["\143\151\x74\x79"]; goto bgAnR; V28od: $this->render("\x6c\157\147\x69\156", $data, $msg, $lp2wr); goto ePOEG; lQFE2: $data["\x62\x69\156\x64\x5f\x75\x6e\151\x6f\x6e\151\144"] = isset($WDqJN["\x75\156\151\157\x6e\151\144"]) ? $WDqJN["\165\156\151\x6f\156\151\144"] : 0; goto JLmoW; eK5Pq: $XKzDw = array(); goto RCf_K; EmYeZ: $msg = __("\xe6\xa3\x80\xe6\265\x8b\347\273\x91\345\256\x9a\345\244\261\xe8\264\xa5"); goto CWvnj; xbbNk: $data["\142\x69\x6e\x64\137\x74\171\160\x65"] = User_BindConnectModel::WEIXIN; goto ES_wD; kmwDv: $e5Ay1 = s("\x63\157\x64\145", null); goto nwri1; I1Pq_: AaSM4: goto otFQc; MYHHn: $data = $WDqJN; goto eXlTp; JZf3b: $odsTb = $this->api->getOauthAccessToken($e5Ay1); goto mctp0; otFQc: y8Oac: goto BP7QG; CwamJ: $l50Le = new User_BindConnectModel(); goto zZHH_; ES_wD: $data["\165\x73\145\x72\x5f\151\144"] = $YKJ9A; goto r8Abm; wxJTq: goto pZvwI; goto wZEHL; i8iS3: $data["\x62\x69\x6e\x64\x5f\147\x65\x6e\144\x65\162"] = $WDqJN["\x73\x65\170"]; goto rZ0p5; gUyv2: $WDqJN = $this->api->getOauthUserinfo($odsTb["\141\143\x63\145\163\x73\x5f\x74\x6f\x6b\145\x6e"], $odsTb["\157\x70\x65\156\151\144"]); goto samxD; VwsG3: User_BaseModel::addStoreSourceUserId($data["\x75\x73\x65\162\x5f\151\144"]); goto KKJLP; ZD8tf: AlESv: goto gUyv2; DJuum: $gXoTn["\165\x73\145\162\x5f\x67\x65\x6e\144\145\162"] = $WDqJN["\163\145\x78"]; goto eUj4M; rZ0p5: $data["\x62\151\x6e\144\137\x63\x6f\x75\156\x74\x72\171"] = $WDqJN["\x63\157\x75\x6e\x74\x72\171"]; goto bxxYr; Q6sC9: $msg = "\x73\165\143\143\145\163\x73"; goto GOYTt; r8Abm: $data["\x62\151\x6e\x64\x5f\x6e\151\x63\153\x6e\141\x6d\x65"] = $WDqJN["\x6e\151\143\153\156\141\155\145"]; goto qlc0G; Yy_D1: mib1t: goto wFUkW; samxD: $oPeFk = sprintf("\x25\163\137\45\x73", "\167\x65\x69\170\x69\156", $WDqJN["\x6f\x70\145\156\x69\144"]); goto vg58T; bgAnR: $data["\142\151\156\144\x5f\157\160\x65\x6e\x69\x64"] = $WDqJN["\x6f\160\x65\156\x69\144"]; goto lQFE2; x66Wz: if (Zero_Perm::checkUserPerm()) { goto LLcIV; } goto gEcjt; KKJLP: VXAsQ: goto EzOmm; FXjAE: nQObc: goto CN2bE; ePOEG: } public function jscode2session() { goto oORhd; eMG3D: $Aq39y[] = $YKJ9A; goto MebVU; CyHWp: tYSCd: goto hRBzQ; K0KsR: $data = $data + (array) $rtpff->doLogin($YKJ9A); goto DFR46; MebVU: if (!$YKJ9A) { goto OXz1j; } goto K2i6s; JuW71: dFmpz: goto PmNH_; MBFC0: $WDqJN = decode_json($WJFDO); goto ISF_w; sY7jP: $gXoTn["\165\163\x65\162\x5f\141\x76\x61\x74\x61\162"] = $WDqJN["\141\166\x61\164\141\x72\125\x72\x6c"]; goto ju8Fd; QKomf: $data["\x62\151\156\144\137\141\143\x74\x69\x76\145"] = 1; goto TYf6H; AgG_V: F7M5S: goto d_2Eh; e0WVV: $Ol0NA = $QquSP->decryptData($QNLmw, $hkwZ6, $WJFDO); goto U3Wgu; TYf6H: $l50Le = new User_BindConnectModel(); goto NsgPs; d1C4G: $lCtyQ = "\162\145\x67\151\x73\164\162\141\x74\x69\x6f\x6e\x2d\x6f\146\x2d\x77\x65\154\143\x6f\155\x65\x2d\151\156\x66\x6f\162\x6d\x61\164\x69\x6f\x6e"; goto PkQGj; sg_g4: $data["\142\151\156\144\137\147\145\156\x64\x65\x72"] = $WDqJN["\x67\145\156\144\x65\162"]; goto BRoj7; CvV2c: $msg = __("\350\x8e\xb7\345\217\x96\164\157\x6b\x65\156\345\xa4\xb1\350\264\xa5"); goto LBJcP; oSa_0: User_BaseModel::addStoreSourceUserId($YKJ9A); goto oNri3; jD8Ld: $lp2wr = 250; goto LmmAV; H3AeE: Wqj6i: goto X0AYb; qFGgU: if (!Base_ConfigModel::ifStoreFx()) { goto iRrTy; } goto oSa_0; idyrc: $F0wVa->sql->startTransaction(); goto R3wqi; rilXx: $QquSP = new WXBizDataCrypt($this->options["\141\x70\x70\151\144"], $lcQ57["\x73\x65\163\163\151\157\x6e\137\153\145\x79"]); goto e0WVV; XOJpo: $data["\142\151\156\144\x5f\x75\156\151\157\156\x69\144"] = isset($WDqJN["\x75\156\151\157\156\x69\144"]) ? $WDqJN["\x75\x6e\151\157\x6e\x69\144"] : 0; goto Dm7ol; vgGos: OXz1j: goto DLjFK; xodpl: aGqIc: goto mjbRM; LHaDT: E7bVq: goto iKr2M; iKr2M: YQKKW: goto wxpG0; zQVIv: $msg = __("\xe8\xbf\x94\xe5\x9b\236\346\x95\260\xe6\215\xae\351\x94\231\350\xaf\xaf"); goto jD8Ld; T9YsI: $data["\142\x69\x6e\x64\137\x63\x69\x74\x79"] = $WDqJN["\143\151\x74\171"]; goto uqKeC; eyO6T: $data["\142\151\156\144\137\162\145\146\x72\145\x73\150\137\164\157\153\x65\156"] = ''; goto QKomf; DLjFK: if (is_ok($Aq39y) && $F0wVa->sql->commit()) { goto F7M5S; } goto MkMoF; b7Xxv: hLylv: goto wvIfW; d_2Eh: Qw1iN: goto pX9DV; Cxil7: lQxn_: goto zWlxj; Uz9hC: $msg = $Ol0NA; goto usg50; ju8Fd: $gXoTn["\165\x73\145\162\137\x67\145\x6e\144\x65\162"] = $WDqJN["\147\145\x6e\144\145\x72"]; goto FXaf_; p80eD: Mo3gn: goto CTXlW; mzVmK: $Aq39y = array(); goto eMG3D; um1ys: $data["\142\x69\x6e\144\137\x70\162\x6f\166\151\156\x63\x65"] = $WDqJN["\x70\162\157\166\x69\x6e\x63\x65"]; goto T9YsI; y6ODo: if (!Base_ConfigModel::ifPlantformFx()) { goto dFmpz; } goto sBwKl; nDyhl: if ($aR_D0 = User_BaseModel::getInstance()->getByAccount($oPeFk)) { goto Enh7O; } goto amzvw; NU1IA: $YKJ9A = $aR_D0["\165\163\x65\162\x5f\x69\x64"]; goto mzVmK; ldOjO: $data = array(); goto NTlLd; sf7Jt: $WJFDO = ''; goto rilXx; wLkb4: goto Qw1iN; goto AgG_V; usg50: $lp2wr = 250; goto V1ABW; CTXlW: $msg = @$JOpS7; goto G8V6l; LBJcP: $lp2wr = 250; goto cjWVH; hRBzQ: $msg = __(''); goto tdl7n; amzvw: $F0wVa = User_InfoModel::getInstance(); goto idyrc; CvwhR: $lcQ57 = $this->api->getJsCode2Session($e5Ay1); goto FFp6m; V5ZcU: check_rs($JOpS7, $Aq39y); goto ldOjO; X0AYb: MKwEY: goto LHaDT; TPUKi: $gXoTn["\165\x73\145\x72\x5f\156\151\143\153\156\x61\155\x65"] = $WDqJN["\156\x69\x63\x6b\116\141\x6d\145"]; goto sY7jP; wxpG0: $this->render("\154\x6f\x67\151\x6e", $data, $msg, $lp2wr); goto ZZ72X; DFR46: $data = $data + (array) User_InfoModel::getInstance()->getUserOne($YKJ9A); goto H3AeE; FQrat: $hkwZ6 = s("\x69\x76"); goto sf7Jt; oNri3: iRrTy: goto SYP_I; pX9DV: goto Szryh; goto YT2KO; K2i6s: $gXoTn = array(); goto TPUKi; LmmAV: goto YQKKW; goto I7JfB; jMRS0: if (Zero_Perm::checkUserPerm()) { goto lQxn_; } goto jIvfp; BhVJV: $data["\x62\x69\x6e\x64\137\156\x69\x63\x6b\x6e\141\155\145"] = $WDqJN["\x6e\x69\x63\x6b\116\141\155\145"]; goto cnvtB; NsgPs: $JOpS7 = $l50Le->checkBind($oPeFk, User_BindConnectModel::WEIXIN, $YKJ9A, $data, true); goto cqoFg; YB0uZ: $data["\x62\151\156\x64\x5f\x74\x79\160\145"] = User_BindConnectModel::WEIXIN; goto ZkLfM; DPKDK: $data = $WDqJN; goto adq0Q; oORhd: $e5Ay1 = s("\x63\x6f\x64\145", null); goto Z0zaq; EkNaj: l1FYt: goto d1C4G; PT4g5: goto aGqIc; goto Cxil7; Dm7ol: $data["\142\151\x6e\x64\x5f\x61\x63\x63\x65\163\163\137\x74\157\x6b\x65\x6e"] = ''; goto Gn3HX; wvIfW: $QNLmw = urldecode(s("\145\x6e\x63\162\x79\x70\164\145\144\104\x61\x74\141")); goto FQrat; fteH3: $lp2wr = 250; goto LdpE5; Gn3HX: $data["\142\x69\156\144\137\145\170\160\151\x72\x65\163\137\x69\x6e"] = ''; goto eyO6T; adq0Q: if ($YKJ9A) { goto Mo3gn; } goto sEItF; cqoFg: check_rs($JOpS7, $Aq39y); goto y6ODo; cnvtB: $data["\x62\151\156\x64\x5f\151\x63\157\x6e"] = $WDqJN["\x61\166\x61\164\141\162\x55\x72\154"]; goto sg_g4; PkQGj: $XKzDw = array(); goto m3JPj; sBwKl: User_BaseModel::addSourceUserId($YKJ9A); goto JuW71; zWlxj: $YKJ9A = Zero_Perm::getUserId(); goto xodpl; BRoj7: $data["\142\x69\156\x64\x5f\143\x6f\x75\156\164\162\x79"] = $WDqJN["\x63\157\165\x6e\164\162\x79"]; goto um1ys; ZkLfM: $data["\x75\x73\x65\x72\137\x69\x64"] = $YKJ9A; goto BhVJV; ovF1u: $YKJ9A = $aR_D0["\x75\163\x65\x72\x5f\151\144"]; goto qFGgU; ISF_w: $oPeFk = sprintf("\45\163\137\45\x73", "\x77\x78\x61\160\x70", $WDqJN["\157\x70\x65\156\x49\144"]); goto nDyhl; SYP_I: Szryh: goto DPKDK; R3wqi: $aR_D0 = $F0wVa->register($oPeFk, rand(1000000000, 9999999999), null, null, null, false); goto NU1IA; YT2KO: Enh7O: goto ovF1u; PmNH_: if (!Base_ConfigModel::ifStoreFx()) { goto l1FYt; } goto ldRxD; uqKeC: $data["\x62\151\x6e\144\x5f\157\x70\x65\156\x69\144"] = $WDqJN["\x6f\160\145\156\x49\144"]; goto XOJpo; tdl7n: $lp2wr = 200; goto MBFC0; mjbRM: if ($e5Ay1) { goto g_ptY; } goto zQVIv; MkMoF: $F0wVa->sql->rollBack(); goto wLkb4; cjWVH: goto E7bVq; goto b7Xxv; U3Wgu: if ($Ol0NA == 0) { goto tYSCd; } goto Uz9hC; sEItF: $msg = __("\xe6\xa3\200\xe6\xb5\x8b\347\xbb\x91\xe5\xae\x9a\xe5\xa4\xb1\xe8\264\xa5"); goto fteH3; LdpE5: goto Wqj6i; goto p80eD; NTlLd: $data["\142\x69\x6e\144\137\x69\x64"] = $oPeFk; goto YB0uZ; m3JPj: Message_TemplateModel::getInstance()->sendNoticeMsg($data["\165\163\x65\162\137\151\x64"], 0, $lCtyQ, $XKzDw); goto vgGos; I7JfB: g_ptY: goto CvwhR; G8V6l: $rtpff = new LoginModel(); goto K0KsR; ldRxD: User_BaseModel::addStoreSourceUserId($YKJ9A); goto EkNaj; Z0zaq: $data = array(); goto jMRS0; jIvfp: $YKJ9A = 0; goto PT4g5; FXaf_: $JOpS7 = User_InfoModel::getInstance()->editAccount($YKJ9A, $gXoTn); goto V5ZcU; FFp6m: if ($lcQ57) { goto hLylv; } goto CvV2c; V1ABW: goto MKwEY; goto CyHWp; ZZ72X: } public function share() { goto OEL8t; yiKtB: if (!$njn1R) { goto Fr1pt; } goto fMrwv; NGUiA: $Jdw35 = $this->api->checkAuth(); goto km9KR; wK7gb: print_r(encode_json($data)); goto EnaSE; fMrwv: $y4spJ = s("\150\162\145\146"); goto PHPHJ; hqjWZ: $data = array(sprintf("\350\x8e\267\xe5\217\226\x6a\x73\137\164\x69\143\153\145\x74\xe5\xa4\261\xe8\xb4\xa5\x3a\x20\x25\x73", $this->api->errCode)); goto wK7gb; QLRYx: Fr1pt: goto hqjWZ; IGkwN: fFJ4A: goto FxHxs; ZX6O6: goto fFJ4A; goto QLRYx; PHPHJ: $data = $this->api->getJsSign($y4spJ); goto ZX6O6; km9KR: $njn1R = $this->api->getJsTicket(); goto yiKtB; OEL8t: $data = array(); goto NGUiA; FxHxs: $this->render("\x6c\x6f\x67\x69\x6e", $data); goto rjv35; EnaSE: die; goto IGkwN; rjv35: } public function wxConfig() { goto KCqhp; QtvUJ: $Jdw35 = $this->api->checkAuth(); goto gTHsR; se1BC: GFT66: goto HtSlS; GKsmf: if (Base_ConfigModel::getConfig("\x70\x6c\141\x6e\164\146\x6f\x72\x6d\x5f\x66\x78\137\145\156\141\142\154\145")) { goto L_peh; } goto bEXB9; WRe0T: die; goto VCO40; KCqhp: $data = array(); goto QtvUJ; DXKRL: print_r(encode_json($data)); goto WRe0T; gTHsR: $njn1R = $this->api->getJsTicket(); goto vqOyO; vqOyO: if (!$njn1R) { goto GFT66; } goto P74e1; cPoZ_: $data["\x64\x61\164\141"]["\x68\x72\x65\146"] = $y4spJ . "\x26\106\130\x3d" . $HfrY1; goto dFIlP; P74e1: $y4spJ = s("\x68\162\x65\146"); goto ljVK2; jTLM4: goto VY8U5; goto LrO7e; LrO7e: L_peh: goto L_8Mo; NxDz1: $this->render("\x6c\x6f\x67\x69\156", $data); goto yd0Z6; L_8Mo: $HfrY1 = Zero_Perm::getUserId(); goto cPoZ_; HtSlS: $data = array(sprintf("\350\216\xb7\345\217\226\x6a\x73\x5f\164\x69\143\x6b\145\x74\345\244\261\350\264\xa5\72\x20\45\x73", $this->api->errCode)); goto DXKRL; bEXB9: $data["\x64\x61\164\141"]["\x68\x72\145\x66"] = $y4spJ; goto jTLM4; rD_SC: goto qpNZ1; goto se1BC; ljVK2: $data = $this->api->getJsSign($y4spJ); goto GKsmf; dFIlP: VY8U5: goto rD_SC; VCO40: qpNZ1: goto NxDz1; yd0Z6: } public function wxPayConfig() { $data = array(); $this->render("\x6c\157\x67\x69\156", $data); } public function getQRCode() { goto e2SuK; i6Zww: goto NoBLQ; goto GGtTA; gESyJ: $qHHLI["\146\x78\x69\x64"] = $mAidM; goto FL4yd; GWxUX: $qHHLI["\163\x63\x65\156\x65\x5f\x69\144"] = s("\163\x63\x65\156\145\x5f\151\x64", "\151\x6e\144\x65\x78"); goto p_OLA; POjhH: $_REQUEST["\163\x69\x74\145"] = array("\143\x6f\x6e\146\x69\x67\137\153\145\x79" => "\x6d\x70\137\x69\x6d\147\x5f\165\162\154", "\x63\157\x6e\x66\x69\147\x5f\x76\x61\x6c\165\145" => $y4spJ, "\143\157\156\146\151\147\137\164\171\x70\145" => "\x73\151\x74\x65", "\x63\157\x6e\146\x69\x67\x5f\164\x79\x70\x65" => "\163\x69\164\x65"); goto skcVf; CdbvH: $Lnyue = $this->api->getQRCode($K9A07); goto ITiK9; q1lIO: NK4a2: goto XfI9D; NdGCr: $data = $Lnyue; goto hR5gT; miWMF: goto NK4a2; goto X3cqe; FL4yd: WjcGU: goto m5qZP; KSpE9: $_REQUEST["\143\x6f\156\146\x69\147\x5f\x74\x79\160\145"][] = "\163\151\x74\x65"; goto POjhH; iOgjT: if (!$Lnyue) { goto qj9U4; } goto NdGCr; e2SuK: $this->options = array("\x61\x70\160\151\144" => Base_ConfigModel::getConfig("\x77\x65\143\x68\x61\x74\137\141\x70\x70\137\x69\144"), "\x61\x70\x70\x73\145\x63\162\145\164" => Base_ConfigModel::getConfig("\167\145\x63\150\x61\x74\x5f\x61\160\160\x5f\163\x65\x63\162\x65\x74"), "\x63\x61\143\x68\x65\137\156\x61\x6d\x65" => "\167\x65\143\150\141\164"); goto MO0Ct; MO0Ct: $this->api = new Zero_Api_Wechat($this->options); goto VhnTv; P7eRs: $K9A07 = http_build_query($qHHLI); goto bM_2k; hR5gT: $y4spJ = $this->api->getQRUrl($Lnyue["\164\x69\143\x6b\x65\164"]); goto YmxC5; Opx1a: rFqLr: goto miWMF; YmxC5: $data["\x75\162\x6c"] = $y4spJ; goto Ikx2f; JNVbQ: $K9A07 = s("\x73\x63\x65\x6e\x65\137\151\144", "\151\x6e\x64\x65\170"); goto wDnh1; ITiK9: NoBLQ: goto iOgjT; XfI9D: $this->render("\x6c\157\x67\x69\156", $data); goto kO17f; X3cqe: qj9U4: goto q1lIO; VhnTv: $data = array(); goto JNVbQ; p_OLA: if (!($mAidM = i("\146\170\151\144"))) { goto WjcGU; } goto gESyJ; V44ss: JZIEm: goto P7eRs; wDnh1: if (is_numeric($K9A07)) { goto NnYvI; } goto GWxUX; Ikx2f: if (!("\x69\x6e\144\145\170" == $K9A07)) { goto rFqLr; } goto KSpE9; GGtTA: NnYvI: goto CdbvH; Qiuja: $qHHLI["\x63\x68\x61\151\156\137\151\144"] = $dcxk0; goto V44ss; skcVf: Base_ConfigModel::getInstance()->save(); goto Opx1a; m5qZP: if (!($dcxk0 = i("\143\x68\x61\151\156\137\151\x64"))) { goto JZIEm; } goto Qiuja; bM_2k: $Lnyue = $this->api->getQRCode($K9A07, 2); goto i6Zww; kO17f: } public function getMiniAppQRCode() { goto AQyfG; yoKQD: DdL_O: goto FIAKU; Lf1Uz: goto Uz9a8; goto eii93; eii93: DGT3D: goto isuyq; aoL36: $msg = ''; goto MemF1; isuyq: $msg = "\105\122\x52\x4f\122\137\x43\122\x45\101\x54\105\x5f\x44\111\x52"; goto zl1Nt; H2Nqj: goto wXQBV; goto k0AHI; CE8dg: goto hjflC; goto yoKQD; QNLaw: $y4spJ = sprintf("\x25\x73\57\x61\143\143\x6f\165\156\x74\x2f\x64\141\164\x61\57\x6d\145\x64\x69\x61\57\160\154\x61\156\164\x66\x6f\x72\155\x2f\170\143\x78\x2f\x25\x73\x2e\x70\x6e\x67", Zero_Registry::get("\142\x61\x73\145\x5f\x75\x72\154"), $I8J5y); goto V2srE; lI0iQ: if (!file_exists($VvFQP) && !mkdir($VvFQP, 511, true)) { goto DGT3D; } goto kZAsU; zl1Nt: Uz9a8: goto H2Nqj; k0AHI: LfhBh: goto LNy2M; b83MP: $_REQUEST["\163\151\164\x65"] = array("\143\x6f\x6e\146\x69\147\x5f\153\x65\171" => "\x78\x63\x78\x5f\151\x6d\147\x5f\165\x72\154", "\x63\x6f\156\146\151\147\137\166\x61\x6c\165\145" => $y4spJ, "\x63\157\x6e\146\x69\147\x5f\164\x79\x70\145" => "\x73\151\x74\x65", "\x63\157\x6e\146\151\x67\137\164\x79\x70\x65" => "\163\151\164\x65"); goto Xwxnd; FIAKU: $msg = "\105\x52\122\117\122\x5f\x44\111\x52\x5f\x4e\x4f\x54\x5f\127\x52\111\x54\x45\101\102\114\x45"; goto ZcT6d; V2srE: $QJMmn = sprintf("\x25\x73\x2f\144\141\x74\141\57\x6d\145\144\x69\141\57\x70\154\141\x6e\164\146\157\x72\155\x2f\170\143\170\57\45\163\x2e\x70\156\147", APP_PATH, $I8J5y); goto CRSAD; MemF1: if (!$Lnyue) { goto LfhBh; } goto GeCp3; GeCp3: $I8J5y = "\141\x63\157\144\x65"; goto QNLaw; Xwxnd: Base_ConfigModel::getInstance()->save(); goto CE8dg; Lz_ie: file_put_contents($QJMmn, $Lnyue); goto FYAe0; LNy2M: wXQBV: goto gOL8i; kZAsU: if (!is_writeable($VvFQP)) { goto DdL_O; } goto Lz_ie; Xhr5w: $Lnyue = $this->api->getWxAcode($QtCY3); goto aoL36; MS9iZ: $QtCY3 = s("\160\141\x74\150"); goto Xhr5w; AQyfG: $this->options = array("\x61\x70\x70\151\144" => Base_ConfigModel::getConfig("\167\x65\143\x68\x61\164\x5f\x78\143\170\x5f\141\160\160\137\x69\144"), "\x61\160\160\163\x65\143\162\x65\164" => Base_ConfigModel::getConfig("\167\x65\x63\150\x61\164\x5f\170\143\x78\x5f\x61\160\160\x5f\163\x65\x63\162\145\164"), "\x63\x61\143\x68\145\x5f\x6e\141\x6d\x65" => "\167\145\143\x68\x61\164"); goto qZ9s3; ZcT6d: hjflC: goto Lf1Uz; CRSAD: $VvFQP = dirname($QJMmn); goto lI0iQ; PAIw5: $_REQUEST["\143\157\156\146\151\147\137\164\x79\160\145"][] = "\163\x69\x74\x65"; goto b83MP; VDfnZ: $data = array(); goto MS9iZ; qZ9s3: $this->api = new Zero_Api_Wechat($this->options); goto VDfnZ; FYAe0: $data["\x75\x72\154"] = $y4spJ; goto PAIw5; gOL8i: $this->render("\x6c\157\147\151\x6e", $data, $msg); goto C6C2l; C6C2l: } public function getMiniAppQRCodeUnlimit() { goto FXUtd; DE0Vu: $msg = "\105\x52\x52\x4f\122\x5f\104\x49\x52\137\x4e\117\x54\x5f\127\x52\x49\124\x45\x41\102\114\x45"; goto TZFEr; ncQ7D: if (!file_exists($VvFQP) && !mkdir($VvFQP, 511, true)) { goto oIY1Y; } goto SU6FF; HpYaF: GFsPW: goto YbXWg; zvhg_: goto GFsPW; goto mtj_N; RGuDy: $OWmFf["\165\x73\145\162\x5f\x69\x64"] = i("\165\163\145\x72\x5f\x69\144"); goto p3pLq; YbXWg: $this->render("\x6c\157\147\151\156", $data); goto Moe1j; tXjIv: $data["\x75\162\x6c"] = $y4spJ; goto cxA8X; DfxLv: file_put_contents($QJMmn, $Lnyue); goto tXjIv; dX0iH: oIY1Y: goto v6YEO; cxA8X: goto gsckM; goto TAatg; d13fE: $OWmFf["\x69\164\145\x6d\137\151\x64"] = i("\x69\x74\x65\155\137\x69\x64"); goto RGuDy; XOafR: $I8J5y = md5(encode_json($OWmFf)); goto M1H7c; YsCU8: if (!$Lnyue) { goto K9kIR; } goto HxG3J; TnU8N: $Lnyue = $this->api->getWxAcodeUnlimit($iVDw9, $W9FSV); goto YsCU8; lmE2F: zxDph: goto zvhg_; TZFEr: gsckM: goto GQaFF; GQaFF: goto zxDph; goto dX0iH; FXUtd: $this->options = array("\141\160\x70\151\144" => Base_ConfigModel::getConfig("\167\145\143\150\x61\x74\x5f\x78\x63\170\x5f\141\x70\x70\x5f\x69\144"), "\141\x70\160\163\145\143\162\145\164" => Base_ConfigModel::getConfig("\x77\145\x63\150\x61\x74\x5f\170\143\x78\x5f\141\160\160\x5f\163\x65\x63\162\145\x74"), "\x63\x61\143\150\x65\137\x6e\141\x6d\145" => "\167\145\143\x68\x61\164"); goto iDy6g; gHWhi: $OWmFf["\160\x61\164\x68"] = $QtCY3; goto d13fE; HxG3J: $OWmFf = array(); goto gHWhi; TAatg: EU08w: goto DE0Vu; SU6FF: if (!is_writeable($VvFQP)) { goto EU08w; } goto DfxLv; M1H7c: $y4spJ = sprintf("\45\163\57\x61\x63\x63\157\x75\x6e\x74\57\144\141\x74\x61\57\155\x65\x64\x69\x61\x2f\160\x6c\141\156\164\x66\157\162\x6d\57\170\143\x78\57\164\145\155\160\57\x25\163\x2e\160\156\x67", Zero_Registry::get("\x62\x61\163\x65\x5f\x75\162\154"), $I8J5y); goto zlU25; F98RN: $VvFQP = dirname($QJMmn); goto ncQ7D; NgCtH: $TQ_wJ = parse_url($QtCY3); goto scAV6; v6YEO: $msg = "\105\x52\x52\x4f\122\x5f\x43\122\105\x41\x54\105\137\x44\x49\122"; goto lmE2F; zlU25: $QJMmn = sprintf("\45\163\57\144\x61\164\x61\57\155\x65\144\x69\x61\57\160\x6c\x61\x6e\x74\146\157\162\155\x2f\x78\143\x78\x2f\164\145\155\160\57\x25\163\56\x70\156\147", APP_PATH, $I8J5y); goto F98RN; scAV6: $iVDw9 = $TQ_wJ["\x71\x75\x65\162\x79"]; goto UZ_eL; iDy6g: $this->api = new Zero_Api_Wechat($this->options); goto cdhcJ; p3pLq: $OWmFf["\141\143\x74\x69\x76\x69\x74\171\x5f\151\144"] = i("\x61\x63\x74\x69\166\x69\x74\171\x5f\151\x64"); goto XOafR; UZ_eL: $W9FSV = ltrim($TQ_wJ["\160\141\164\x68"], "\57"); goto TnU8N; cdhcJ: $QtCY3 = s("\x70\x61\164\150", s("\x50\x61\164\150")); goto NgCtH; mtj_N: K9kIR: goto HpYaF; Moe1j: } } goto kcTbF; EwOYw: if (defined("\x52\x4f\117\124\137\120\x41\124\110")) { goto t9j6M; } goto n4_jR; i5Hbq: class WXBizDataCrypt { private $appid; private $sessionKey; public function WXBizDataCrypt($u3aBL, $wny1B) { $this->sessionKey = $wny1B; $this->appid = $u3aBL; } public function decryptData($QNLmw, $hkwZ6, &$data) { goto urnix; g4MtQ: return WxErrorCode::$IllegalIv; goto XXrwT; RZ59o: $AVvyp = base64_decode($hkwZ6); goto FGXmi; XXrwT: h00dH: goto RZ59o; urnix: if (!(strlen($this->sessionKey) != 24)) { goto WJu3L; } goto RzF24; R3nzS: $l4c3e = base64_decode($this->sessionKey); goto VCkcT; HARXb: WJu3L: goto R3nzS; xtCyx: if (!($IJslb == NULL)) { goto Nd9N_; } goto kFZtI; kFZtI: return WxErrorCode::$IllegalBuffer; goto nZfRg; VCkcT: if (!(strlen($hkwZ6) != 24)) { goto h00dH; } goto g4MtQ; o4Wrx: return WxErrorCode::$OK; goto yWwKB; jJ1Th: $IJslb = json_decode($A0HE9); goto xtCyx; H1EKT: $A0HE9 = openssl_decrypt($uUGnd, "\x41\105\123\55\61\62\x38\55\103\102\103", $l4c3e, 1, $AVvyp); goto jJ1Th; B6P_N: if (!($IJslb->watermark->appid != $this->appid)) { goto ROYJB; } goto I4WJ_; KP1k_: $data = $A0HE9; goto o4Wrx; jQJzg: ROYJB: goto KP1k_; nZfRg: Nd9N_: goto B6P_N; I4WJ_: return WxErrorCode::$IllegalBuffer; goto jQJzg; FGXmi: $uUGnd = base64_decode($QNLmw); goto H1EKT; RzF24: return WxErrorCode::$IllegalAesKey; goto HARXb; yWwKB: } }
