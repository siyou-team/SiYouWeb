<?php
/*   __________________________________________________
    |  zeroframework  1.8.8                          |
    |__________________________________________________|
*/
 goto s65Gj; jAPXJ: require_once LIB_PATH . "\x2f\101\x70\x69\x2f\167\170\57\x6c\x69\142\x2f\x57\170\120\141\171\56\x4e\157\164\x69\x66\171\56\160\150\x70"; goto Aeb5T; Je7aH: glwsg: goto uz6Ia; uz6Ia: require_once LIB_PATH . "\57\101\x70\151\57\x77\x78\57\x6c\151\x62\57\x57\x78\120\141\171\x2e\x41\160\x69\56\x70\150\x70"; goto jAPXJ; AmQJs: die("\116\x6f\40\120\x65\162\x6d\x69\x73\163\151\157\x6e"); goto Je7aH; s65Gj: if (defined("\122\x4f\x4f\124\137\x50\x41\x54\x48")) { goto glwsg; } goto AmQJs; Aeb5T: class Payment_WxNativeModel extends WxPayNotify implements Payment_Interface { protected $payment; protected $order; private $code = "\x77\x78\x5f\156\141\x74\x69\166\145"; private $parameter; private $order_type; private $verifyResult = false; private $verifyData = array(); private $returnResult = false; private $returnData = array(); public function __construct($VfMM2 = array(), $bWATN = array()) { goto LXyYk; eSqqS: $this->payment["\x6e\x6f\x74\151\x66\x79\x5f\165\162\x6c"] = Zero_Registry::get("\141\x70\x70\x5f\x75\162\154") . "\57\141\160\151\57\x70\x61\x79\x6d\145\x6e\x74\x2f\x77\x78\x2f\156\x6f\164\x69\146\171\x5f\165\162\154\x2e\160\150\160"; goto Y4xqy; LXyYk: $this->payment = $VfMM2; goto NdinD; Y4xqy: $this->payment["\162\x65\164\x75\x72\156\137\x75\162\x6c"] = Zero_Registry::get("\141\160\x70\x5f\165\x72\154") . "\x2f\141\x70\x69\x2f\x70\141\171\155\145\x6e\x74\57\x77\170\57\x72\145\164\x75\162\x6e\137\x75\x72\x6c\56\x70\150\x70"; goto LdB3s; cKOHy: $this->payment["\x61\160\x70\163\145\x63\162\145\164"] = $VfMM2["\x61\160\x70\163\x65\x63\162\x65\x74"]; goto JCGFI; NdinD: $this->order = $bWATN; goto e_IH8; iXS1W: $this->payment["\x6a\x75\x6d\160\x5f\x75\162\x6c"] = Zero_Registry::get("\141\160\x70\x5f\x75\x72\x6c") . "\x2f\141\160\x69\x2f\x70\141\x79\x6d\x65\156\x74\57\x77\x78\57\x72\145\x74\x75\162\156\x5f\x75\162\154\x2e\x70\150\160"; goto X8Blr; UNDbK: $this->payment["\x63\x75\162\x6c\137\x70\162\157\170\x79\x5f\x70\157\162\164"] = 0; goto YFOcj; JCGFI: $this->payment["\163\x73\154\143\x65\x72\164\137\160\141\x74\150"] = LIB_PATH . "\x2f\101\160\151\57\x77\x78\x2f\x63\x65\162\164\57\141\160\151\143\x6c\x69\x65\156\164\137\x63\145\x72\164\56\160\x65\x6d"; goto FTAQv; YFOcj: $this->payment["\x72\x65\160\157\x72\164\x5f\154\x65\166\145\156\x6c"] = 1; goto kiq4_; e_IH8: $this->payment["\141\x70\160\151\x64"] = $VfMM2["\x61\160\160\151\144"]; goto upPmU; VB0ZA: $this->payment["\x6b\x65\171"] = $VfMM2["\x6b\145\x79"]; goto cKOHy; upPmU: $this->payment["\155\x63\x68\151\144"] = $VfMM2["\x6d\x63\x68\x69\x64"]; goto VB0ZA; LdB3s: $this->payment["\x63\150\145\x63\153\137\x75\162\154"] = Zero_Registry::get("\x61\160\160\137\165\x72\154") . "\57\141\x70\151\57\160\x61\171\155\145\x6e\x74\x2f\x77\x78\x2f\143\150\145\x63\x6b\137\165\x72\x6c\56\x70\x68\x70"; goto vDm0J; FTAQv: $this->payment["\x73\163\154\153\145\x79\x5f\x70\141\x74\x68"] = LIB_PATH . "\x2f\x41\160\x69\x2f\167\170\57\x63\145\x72\164\57\141\160\x69\x63\x6c\151\145\x6e\164\x5f\153\145\x79\x2e\160\x65\x6d"; goto IVRdw; kiq4_: $this->payment["\160\x61\171\155\x65\x6e\x74\x5f\164\x79\160\145"] = "\116\x41\124\x49\x56\105"; goto eSqqS; IVRdw: $this->payment["\143\165\162\154\x5f\160\162\x6f\x78\x79\x5f\x68\157\163\x74"] = "\x30\56\x30\56\60\56\x30"; goto UNDbK; vDm0J: $this->payment["\155\x65\x72\x63\x68\x61\156\164\x5f\x75\x72\x6c"] = Zero_Registry::get("\141\160\160\x5f\165\162\x6c") . "\57\x61\x70\151\x2f\160\x61\171\155\145\x6e\164\x2f\x77\x78\x2f\155\145\162\x63\150\x61\x6e\164\137\x75\162\154\x2e\x70\x68\x70"; goto iXS1W; X8Blr: } public function pay($bWATN) { goto Lhvh6; VIa2S: $EVT_4["\x63\x68\145\143\153\137\x75\162\154"] = $jOb0H; goto dO4n6; YjxLj: $V3V5z = Base_ConfigModel::getConfig("\161\162\143\x6f\144\x65\137\x75\162\x6c"); goto X3H4F; g_uwH: $HaKfM->SetNotify_url($this->payment["\156\157\164\151\146\x79\137\165\162\x6c"]); goto KhwPN; fDNrK: $EVT_4["\165\x72\154\137\x64\141\x74\141"] = $KmW_b; goto VIa2S; LtTP1: $LE7n3 = $this->order["\164\162\x61\144\145\137\164\151\x74\x6c\x65"]; goto WKEwY; Jt0X1: $NXnBJ = isset($this->order["\164\x72\141\x64\145\137\x72\x65\155\141\x72\x6b"]) ? $this->order["\164\162\x61\144\145\137\x72\x65\x6d\141\162\153"] : ''; goto c9D0w; WPdve: $HaKfM = new WxPayUnifiedOrder(); goto HsAfh; wBIb_: $this->order = $bWATN; goto dH17V; X3H4F: print "\74\x21\104\117\x43\124\131\120\105\x20\150\164\x6d\154\x3e\xa\x3c\x68\164\155\154\76\12\x3c\x68\x65\141\x64\76\xa\11\x3c\155\145\164\141\40\143\x6f\x6e\x74\x65\x6e\164\x3d\42\164\145\x78\x74\57\150\x74\155\154\x3b\x20\x63\x68\141\162\163\145\164\x3d\165\x74\x66\55\70\42\40\150\x74\x74\x70\55\x65\x71\165\x69\x76\x3d\x22\x43\x6f\156\164\145\156\164\55\x54\171\160\x65\x22\x3e\xa\11\x3c\x6d\145\164\x61\40\156\x61\x6d\x65\75\x22\166\x69\145\x77\x70\x6f\162\164\x22\40\x63\157\156\x74\145\156\164\x3d\x22\x77\151\144\164\150\x3d\x64\x65\166\x69\x63\x65\55\167\x69\144\x74\150\x2c\40\x69\x6e\151\x74\151\141\x6c\55\x73\x63\x61\154\145\x3d\x31\x2e\x30\x22\76\12\11\x3c\163\x63\x72\151\x70\x74\x20\x74\171\160\x65\x3d\42\164\145\170\x74\57\152\141\x76\x61\x73\x63\162\x69\x70\164\x22\x20\163\x72\143\75\x22\x2f\57\143\x6f\144\145\x2e\x6a\161\x75\145\x72\x79\56\143\x6f\155\57\x6a\161\x75\x65\162\171\55\x31\56\71\x2e\61\x2e\155\x69\156\56\x6a\163\x22\x3e\74\x2f\x73\x63\x72\x69\160\x74\x3e\12\x9\x3c\x74\x69\x74\154\145\76\xe5\276\256\xe4\277\xa1\xe4\xba\x8c\347\xbb\xb4\347\240\x81\xe7\x99\273\351\x99\206\xe6\216\245\xe5\x8f\243\x3c\57\x74\x69\164\154\x65\76\xa\11\x3c\x73\164\x79\154\x65\40\x74\171\160\145\75\42\164\x65\x78\x74\x2f\143\163\x73\42\76\12\x9\x62\x6f\144\x79\x20\x7b\xa\x9\11\x62\141\143\153\147\162\157\x75\x6e\144\72\43\146\x66\x66\x3b\12\x9\11\x77\x69\x64\x74\150\72\x20\61\x30\60\x25\x3b\12\11\11\x7a\55\151\156\x64\145\170\x3a\40\55\61\x30\x3b\xa\11\x9\160\141\x64\144\x69\x6e\147\72\x20\60\73\12\x9\x7d\12\11\74\x2f\x73\x74\x79\x6c\x65\x3e\xa\74\57\150\x65\141\144\76\xa\x3c\x62\x6f\x64\x79\x3e\xa\74\144\x69\166\40\151\144\x3d\42\x63\157\156\164\x65\156\164\x22\x20\141\x6c\151\x67\x6e\75\42\x63\x65\156\164\145\x72\x22\x3e\12\40\x20\x20\x20\x3c\x64\151\x76\40\163\164\171\x6c\x65\75\42\155\141\x72\x67\151\x6e\55\154\x65\146\164\72\40\61\60\x70\170\x3b\155\141\x72\x67\x69\x6e\x2d\x74\157\160\72\x31\60\60\x70\x78\x3b\143\157\154\157\x72\x3a\x23\x35\x35\66\102\x32\x46\73\x66\x6f\x6e\164\x2d\x73\151\x7a\145\72\x33\x30\x70\x78\x3b\x66\157\x6e\x74\x2d\x77\x65\x69\x67\x68\x74\72\x20\x62\x6f\154\144\x65\x72\73\42\x3e\xe6\x89\xab\346\217\217\346\224\xaf\344\273\230\xe6\250\xa1\xe5\xbc\x8f\x3c\57\x64\151\x76\76\74\x62\162\57\x3e\12\x9\x3c\151\155\147\40\141\x6c\164\75\x22\346\xa8\241\xe5\xbc\217\xe4\272\x8c\xe6\x89\253\xe7\xa0\x81\346\224\257\344\xbb\x98\x22\x20\x73\x72\x63\x3d\42{$V3V5z}\77\167\75\63\60\x30\46\141\x6d\160\x3b\x68\x3d\63\60\60\46\x75\x72\x6c\75{$KmW_b}\42\x20\x73\x74\171\154\145\x3d\x22\x77\151\x64\164\x68\x3a\63\x30\x30\x70\x78\73\x68\x65\x69\x67\150\x74\x3a\63\60\60\160\x78\73\x22\x2f\x3e\xa\74\57\x64\x69\166\76\xa\74\163\x63\x72\151\x70\164\x20\164\x79\160\x65\x3d\42\x74\145\x78\164\x2f\152\x61\166\141\x73\143\162\x69\160\x74\42\x3e\12\x9\x76\141\x72\40\141\152\141\x78\x6c\x6f\x63\153\40\x3d\x20\146\x61\154\x73\x65\73\xa\x9\166\x61\162\40\141\152\141\170\150\x61\156\x64\154\145\x3b\xa\11\x66\x75\156\143\164\x69\x6f\x6e\x20\x73\171\156\x63\154\x6f\147\151\x6e\50\51\173\12\x9\x9\x69\146\x20\50\x21\141\x6a\141\170\x6c\157\143\153\x29\x20\173\xa\x9\11\x9\44\x2e\x70\x6f\x73\x74\50\x22{$jOb0H}\x22\x2c\x7b\157\162\144\145\162\137\151\144\x3a\x22{$QLWEC}\42\175\x2c\x66\x75\x6e\143\164\x69\157\x6e\50\x72\145\163\165\x6c\x74\x29\173\12\x9\11\x9\11\x9\151\146\x20\x28\162\x65\x73\x75\x6c\x74\x2e\x73\x74\141\164\165\163\75\x3d\62\60\60\51\x20\173\xa\x9\11\11\11\11\40\xa\11\11\x9\x9\x9\11\141\x6a\141\170\154\157\143\153\x20\x3d\40\x74\x72\165\x65\73\12\11\11\11\11\x9\11\167\151\x6e\x64\157\x77\56\x6c\157\143\x61\164\151\157\x6e\x2e\150\162\145\146\x20\75\x20\x22{$I9184}\x22\x3b\xa\x9\x9\x9\x9\x9\x9\143\x6c\145\x61\x72\x49\156\164\x65\x72\166\141\154\x28\x61\152\x61\170\x68\x61\156\144\x6c\145\51\x3b\12\x9\x9\11\x9\x9\175\xa\11\x9\11\175\x2c\x27\x6a\163\x6f\x6e\x27\51\x3b\12\11\x9\175\xa\11\175\12\x9\44\50\x66\x75\x6e\143\x74\x69\157\x6e\x28\51\173\12\x9\x9\x61\x6a\141\170\150\141\156\x64\x6c\145\40\75\x20\x73\145\164\111\x6e\164\145\x72\x76\141\x6c\50\x22\x73\171\156\143\154\157\147\151\x6e\x28\x29\42\x2c\62\60\x30\x30\x29\x3b\12\x9\175\51\73\xa\74\57\163\143\x72\151\x70\164\x3e\12\x3c\57\x62\x6f\144\x79\x3e\xa\74\x2f\x68\x74\155\154\x3e"; goto ygchz; dG1Xk: $BbtaZ = $VyF1U->GetPayUrl($HaKfM); goto Eq8GM; w8Hgj: if (!(StateCode::ORDER_PAID_STATE_YES == $this->order["\164\162\141\x64\x65\137\x69\163\x5f\160\x61\x69\144"])) { goto JoqI1; } goto UZHn2; AykdR: imGeO: goto CC_Ec; ygchz: die; goto RLlsD; xNIpD: $HaKfM->SetAttach($vJPLL); goto Q8eXa; KItRj: $HaKfM->SetProduct_id($QLWEC); goto dG1Xk; dH17V: l_ut2: goto NOMB4; vlUAg: $I9184 = $this->payment["\x6a\x75\x6d\160\137\165\162\x6c"]; goto owYEg; o2Hrs: $hmojQ = isset($this->order["\x71\165\141\x6e\x74\151\164\171"]) ? $this->order["\x71\165\141\156\164\x69\164\171"] : 1; goto yO5ta; NOMB4: $this->payment["\x6a\165\x6d\x70\x5f\x75\162\x6c"] = $this->payment["\152\165\155\160\137\165\x72\x6c"] . "\77\157\x72\144\145\x72\137\151\x64\x3d" . $bWATN["\157\x72\144\x65\x72\137\151\x64"]; goto w8Hgj; CC_Ec: $DXAbt = $BbtaZ["\x63\x6f\x64\145\x5f\x75\x72\x6c"]; goto mxInk; oFWcH: $ni1ub = Zero_Registry::get("\142\x61\163\x65\x5f\x75\162\x6c"); goto YjxLj; AExbm: $jOb0H = $this->payment["\x63\x68\145\143\153\137\165\x72\x6c"]; goto vlUAg; mxInk: $KmW_b = urlencode($DXAbt); goto AExbm; owYEg: $EVT_4 = array(); goto fDNrK; WKEwY: $KTjEG = isset($this->order["\x74\162\x61\144\x65\137\x64\145\163\143"]) ? $this->order["\x74\x72\141\x64\x65\137\144\145\x73\x63"] : ''; goto Jt0X1; Lhvh6: if (!$bWATN) { goto l_ut2; } goto wBIb_; TB5d3: Zero_Log::log("\107\145\164\x50\x61\x79\125\x72\x6c\40\x52\x45\123\x3a\x3d" . encode_json($BbtaZ), Zero_Log::INFO, "\x70\141\x79\137\167\170\x5f\x69\x6e\x66\157"); goto uOl6j; T07yg: include_once LIB_PATH . "\57\x41\160\x69\57\x77\x78\x2f\127\x78\120\x61\171\56\116\x61\x74\x69\x76\145\x50\141\x79\56\160\150\160"; goto iI2yM; U5wYU: $QLWEC = $this->order["\x6f\x72\144\x65\162\x5f\151\144"]; goto LtTP1; HsAfh: $HaKfM->SetBody($LE7n3); goto xNIpD; UZHn2: throw new Exception("\xe8\256\242\345\x8d\x95\347\212\266\346\200\x81\xe4\xb8\x8d\344\270\272\xe5\xbe\x85\xe4\273\230\346\254\276\xe7\x8a\266\xe6\200\x81"); goto tyHOq; xooOh: goto imGeO; goto vT06Z; uOl6j: throw new Exception(encode_json($BbtaZ)); goto xooOh; N1k50: $HaKfM->SetTotal_fee($ldYwy * 100); goto f_zdw; Vjygm: $HaKfM->SetGoods_tag($NXnBJ); goto g_uwH; Q8eXa: $HaKfM->SetOut_trade_no($QLWEC); goto N1k50; KhwPN: $HaKfM->SetTrade_type("\x4e\x41\124\111\126\x45"); goto KItRj; C8yY6: $Uq4qa = time(); goto T07yg; Eq8GM: if ($BbtaZ && "\x53\125\103\103\105\x53\x53" == $BbtaZ["\162\145\163\x75\154\164\137\x63\x6f\144\x65"]) { goto jz_uq; } goto TB5d3; tyHOq: JoqI1: goto U5wYU; f_zdw: $HaKfM->SetTime_start(date("\131\155\x64\x48\x69\x73"), $Uq4qa); goto Vjygm; vT06Z: jz_uq: goto AykdR; dO4n6: $EVT_4["\152\x75\x6d\160\x5f\165\162\154"] = $I9184; goto oFWcH; c9D0w: $ldYwy = $this->order["\164\162\141\x64\145\x5f\160\x61\x79\155\x65\x6e\164\137\x61\155\157\165\156\x74"]; goto o2Hrs; yO5ta: $vJPLL = ''; goto C8yY6; iI2yM: $VyF1U = new NativePay(); goto WPdve; RLlsD: } public function getPayResult($I_Ejk) { return $I_Ejk["\164\162\141\144\x65\x5f\x73\164\x61\164\165\x73"] == "\x54\122\x41\104\x45\137\x53\125\103\x43\x45\123\123"; } public function verifyNotify() { $this->Handle(false); return $this->verifyResult; } public function verifyReturn($QLWEC = null) { goto cXXxx; kHASx: return $this->returnResult; goto nzMsm; ibiJm: $HaKfM = new WxPayOrderQuery(); goto RWM9S; LkGt0: $this->returnResult = true; goto G0yj0; OGSNB: if (!$QLWEC) { goto kdf7f; } goto ibiJm; TPwW3: goto qNqVs; goto KqUtT; Bm17g: Zero_Log::log("\x24\162\x65\x74\165\x72\156\137\162\x65\x73\165\154\164\x3d" . encode_json($eifyw), "\x70\141\171\x5f\x77\x78\137\162\145\x74\165\x72\156", Zero_Log::INFO); goto Q06bP; qieNI: kdf7f: goto Bm17g; Sez94: $eifyw = WxPayApi::orderQuery($HaKfM); goto qieNI; cXXxx: $eifyw = array(); goto OGSNB; ZSOE2: $this->returnResult = false; goto TPwW3; Q06bP: $this->verifyData = $eifyw; goto wqBVL; RWM9S: $HaKfM->SetOut_trade_no($QLWEC); goto Sez94; wqBVL: if (isset($eifyw["\x74\162\141\144\145\x5f\163\x74\x61\x74\145"]) && "\123\125\103\x43\x45\x53\x53" == $eifyw["\164\x72\x61\x64\x65\x5f\163\164\x61\x74\x65"]) { goto bb0OT; } goto ZSOE2; G0yj0: qNqVs: goto kHASx; KqUtT: bb0OT: goto LkGt0; nzMsm: } public function sign($YEHxz) { goto tmQ9n; tmQ9n: $BHkCC = ''; goto dRdyg; dRdyg: $BHkCC = $this->getSignature($YEHxz, $YEHxz["\x6b\145\x79"]); goto Uzm2l; Uzm2l: return $BHkCC; goto ypvVJ; ypvVJ: } public function getSignature($YEHxz, $IBA8H = null) { } public function request() { } public function getNotifyData() { goto o4Y7I; nCK0s: $skaFl["\144\x65\x70\x6f\163\151\164\x5f\141\163\x79\156\143"] = 1; goto SUZPL; SUZPL: return $skaFl; goto ImckP; o4Y7I: $skaFl = $this->getReturnData(); goto nCK0s; ImckP: } public function getReturnData($c7nAl = null) { goto E_ud4; VB5ey: $skaFl["\144\x65\x70\157\x73\x69\x74\x5f\x71\165\141\156\x74\x69\164\171"] = isset($wv9QI["\161\x75\141\156\x74\x69\x74\171"]) ? $wv9QI["\161\x75\141\x6e\164\151\x74\x79"] : "\x30"; goto S7LKX; mJTTX: $M1Xml = Consume_TradeCombineModel::getInstance(); goto xsl1n; XrNdz: $skaFl["\x64\x65\x70\157\163\x69\164\137\x74\x6f\164\x61\x6c\137\146\x65\x65"] = $wv9QI["\164\157\x74\x61\154\137\x66\x65\x65"] / 100; goto W7h0p; qjCUs: if ($Qws2U) { goto SLIuE; } goto MIwMp; tld1q: $skaFl["\144\145\160\157\163\151\x74\137\160\141\x79\x6d\x65\x6e\x74\137\x74\171\x70\x65"] = StateCode::PAYMENT_TYPE_ONLINE; goto t3iLd; MIwMp: $skaFl["\x6f\x72\144\145\x72\x5f\151\144"] = $wv9QI["\x6f\165\164\137\164\162\141\144\145\x5f\x6e\x6f"]; goto Ei_rr; kDIOa: $skaFl["\144\145\x70\157\163\x69\x74\x5f\145\x78\x74\162\x61\137\x70\141\162\x61\155"] = encode_json($wv9QI); goto F_OKZ; uP_Cl: $skaFl["\144\x65\x70\x6f\x73\151\x74\137\142\x75\171\x65\x72\137\151\144"] = $wv9QI["\157\160\145\x6e\x69\x64"]; goto tld1q; cpVV2: $skaFl["\144\145\160\x6f\x73\x69\164\x5f\x69\163\137\164\x6f\x74\x61\154\x5f\146\145\145\x5f\x61\144\152\165\x73\164"] = isset($wv9QI["\151\x73\x5f\x74\x6f\x74\x61\x6c\x5f\146\x65\145\137\141\x64\152\x75\163\164"]) ? $wv9QI["\151\163\137\164\157\164\141\154\x5f\x66\x65\145\137\x61\x64\152\x75\163\164"] : 0; goto XrNdz; jCuhQ: NFiOq: goto gXt5F; EPHvk: return $skaFl; goto fB0Oc; xsl1n: $Qws2U = $M1Xml->getOne($wv9QI["\157\x75\164\x5f\x74\x72\x61\144\145\137\x6e\x6f"]); goto qjCUs; feGky: $skaFl["\x64\x65\160\157\163\151\164\137\x74\162\141\x64\x65\x5f\156\x6f"] = $wv9QI["\x74\x72\141\156\163\x61\x63\x74\x69\157\x6e\137\151\144"]; goto VB5ey; W7h0p: $skaFl["\144\145\x70\x6f\163\x69\x74\137\160\x72\151\143\145"] = isset($wv9QI["\143\x61\163\x68\x5f\x66\x65\x65"]) ? $wv9QI["\x63\141\x73\150\x5f\x66\x65\145"] / 100 : "\60"; goto uP_Cl; Wu3Fo: SLIuE: goto sKAuR; tny6P: $skaFl = array(); goto mJTTX; Ei_rr: goto MiDL5; goto Wu3Fo; n5322: $skaFl["\144\145\x70\157\163\x69\x74\x5f\163\x65\154\x6c\x65\162\137\x69\144"] = $wv9QI["\155\143\150\137\151\x64"]; goto cpVV2; S7LKX: $skaFl["\144\145\160\157\x73\x69\164\137\156\x6f\164\151\x66\x79\137\x74\151\155\145"] = date("\131\55\x6d\55\x64\x20\x48\x3a\151\x3a\x73"); goto n5322; gXt5F: $wv9QI = $this->verifyData; goto tny6P; oH1x4: MiDL5: goto feGky; sKAuR: $skaFl["\157\x72\x64\x65\162\x5f\x69\x64"] = implode("\54", $Qws2U["\x6f\162\144\145\x72\137\151\x64\163"]); goto oH1x4; ODWnJ: $skaFl["\x64\145\x70\x6f\163\151\164\137\163\151\147\156"] = isset($wv9QI["\163\x69\x67\156"]) ? $wv9QI["\163\x69\x67\x6e"] : ''; goto kDIOa; F_OKZ: $skaFl["\160\141\171\x6d\x65\x6e\164\137\143\150\141\x6e\x6e\x65\x6c\137\151\144"] = $this->payment["\160\x61\x79\x6d\145\x6e\x74\x5f\143\x68\x61\x6e\x6e\145\x6c\137\x69\x64"]; goto EPHvk; t3iLd: $skaFl["\x64\x65\160\157\163\151\x74\x5f\163\145\x72\x76\151\143\x65"] = isset($wv9QI["\x74\162\x61\x64\x65\x5f\x74\171\160\x65"]) ? $wv9QI["\164\x72\x61\x64\145\137\164\x79\x70\145"] : ''; goto ODWnJ; E_ud4: if ($c7nAl) { goto NFiOq; } goto jCuhQ; fB0Oc: } public function NotifyProcess($data, &$msg) { goto TD62L; cwqR5: $this->verifyResult = true; goto djgcz; djgcz: $this->verifyData = $data; goto IJGzM; Deilb: return false; goto FgB0O; IJGzM: Zero_Log::log("\x24\x64\x61\x74\141\x3a" . encode_json($data), "\x70\141\x79\x5f\167\x78\156\141\164\x69\166\x65\x5f\x6e\x6f\164\x69\x66\x79", Zero_Log::INFO); goto Wh_p3; ZskpI: return false; goto mVdqW; FgB0O: BFFF7: goto OSrTg; tb4jx: if (array_key_exists("\x74\162\x61\156\163\x61\x63\164\x69\157\156\x5f\x69\144", $data)) { goto BFFF7; } goto zaTxx; zaTxx: $msg = "\350\276\223\xe5\205\245\345\217\x82\xe6\x95\xb0\344\xb8\215\346\xad\xa3\347\241\256"; goto Deilb; OSrTg: if ($this->Queryorder($data["\164\x72\141\156\163\x61\143\164\x69\157\x6e\x5f\x69\x64"])) { goto ny11I; } goto PAI0G; Wh_p3: return true; goto NJc5d; TD62L: Zero_Log::log("\143\141\x6c\x6c\x20\x62\x61\143\x6b\72" . json_encode($data), "\x70\141\x79\x5f\x77\170\x6e\x61\164\x69\166\x65\x5f\156\157\164\x69\x66\x79", Zero_Log::INFO); goto yjBv8; PAI0G: $msg = "\xe8\xae\242\345\215\x95\346\x9f\245\350\xaf\xa2\345\244\261\xe8\264\245"; goto ZskpI; mVdqW: ny11I: goto cwqR5; yjBv8: $rijTC = array(); goto tb4jx; NJc5d: } public function Queryorder($pZ2F_) { goto rED7f; MVIiV: return false; goto jXevl; G0mn3: $BbtaZ = WxPayApi::orderQuery($HaKfM); goto ZjRy5; ZjRy5: Zero_Log::log("\161\165\x65\162\171\x3a" . json_encode($BbtaZ), "\x70\141\171\x5f\167\x78\156\x61\x74\151\166\x65\x5f\156\157\164\x69\x66\x79", Zero_Log::INFO); goto biG74; S3Aeq: $HaKfM->SetTransaction_id($pZ2F_); goto G0mn3; rED7f: $HaKfM = new WxPayOrderQuery(); goto S3Aeq; e3C2k: return true; goto gu7ZT; biG74: if (!(array_key_exists("\x72\145\164\x75\162\x6e\137\143\x6f\x64\x65", $BbtaZ) && array_key_exists("\162\x65\x73\165\x6c\x74\137\x63\x6f\144\x65", $BbtaZ) && $BbtaZ["\162\x65\x74\165\x72\156\137\143\157\144\145"] == "\x53\x55\x43\x43\105\123\x53" && $BbtaZ["\162\145\163\165\154\164\x5f\x63\x6f\144\145"] == "\x53\x55\103\x43\x45\x53\123")) { goto BkpJC; } goto e3C2k; gu7ZT: BkpJC: goto MVIiV; jXevl: } public function getChannelId() { return $this->payment["\x70\141\171\155\x65\x6e\164\137\143\x68\141\156\156\145\x6c\x5f\151\x64"]; } }
