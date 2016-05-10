<?php
/** Adminer - Compact database management
 * @link http://www.adminer.org/
 * @author Jakub Vrana, http://www.vrana.cz/
 * @copyright 2007 Jakub Vrana
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
 * @version 4.2.1
 */error_reporting(6135);
$oc = !preg_match('~^(unsafe_raw)?$~', ini_get("filter.default"));if ($oc || ini_get("filter.default_flags")) {
    foreach (array('_GET', '_POST', '_COOKIE', '_SERVER') as $X) {$Ag = filter_input_array(constant("INPUT$X"), FILTER_UNSAFE_RAW);if ($Ag) {
        $$X = $Ag;
    }
    }}if (function_exists("mb_internal_encoding")) {
    mb_internal_encoding("8bit");
}
if (isset($_GET["file"])) {
    if ($_SERVER["HTTP_IF_MODIFIED_SINCE"]) {header("HTTP/1.1 304 Not Modified");exit;}
    header("Expires: " . gmdate("D, d M Y H:i:s", time() + 365 * 24 * 60 * 60) . " GMT");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");if ($_GET["file"] == "favicon.ico") {
        header("Content-Type: image/x-icon");
        echo
        lzw_decompress("\0\0\0` \0„\0\n @\0´C„è\"\0`EãQ¸àÿ‡?ÀtvM'”JdÁd\\Œb0\0Ä\"™ÀfÓˆ¤îs5›ÏçÑAXPaJ“0„¥‘8„#RŠT©‘z`ˆ#.©ÇcíXÃşÈ€?À-\0¡Im? .«M¶€\0È¯(Ì‰ıÀ/(%Œ\0");} elseif ($_GET["file"] == "default.css") {
        header("Content-Type: text/css; charset=utf-8");
        echo
        lzw_decompress("\n1Ì‡“ÙŒŞl7œ‡B1„4vb0˜Ífs‘¼ên2BÌÑ±Ù˜Şn:‡#(¼b.\rDc)ÈÈa7E„‘¤Âl¦Ã±”èi1Ìs˜´ç-4™‡fÓ	ÈÎi7†³é†„ŒFÃ©”vt2‚Ó!–r0Ïãã£t~½U'3M€ÉW„B¦'cÍPÂ:6T\rc£A¾zr_îWK¶\r-¼VNFS%~Ãc²Ùí&›\\^ÊrÀ›­æu‚ÅÃôÙ‹4'7k¶è¯ÂãQÔæhš'g\rFB\ryT7SS¥PĞ1=Ç¤cIèÊ:d”ºm>£S8L†Jœt.M¢Š	Ï‹`'C¡¼ÛĞ889¤È QØıŒî2#8Ğ­£’˜6mú²†ğjˆ¢h«<…Œ°«Œ9/ë˜ç:Jê)Ê‚¤\0d>!\0Z‡ˆvì»në¾ğ¼o(Úó¥ÉkÔ7½sàù>Œî†!ĞR\"*nSı\0@P\"Áè’(‹#[¶¥£@g¹oü­’znş9k¤8†nš™ª1´I*ˆô=Ín²¤ª¸è0«c(ö;¾Ã Ğè!°üë*cì÷>Î¬E7DñLJ© 1ÊJ=ÓÚŞ1L‚û?Ğs=#`Ê3\$4ì€úÈuÈ±ÌÎzGÑC YAt«?;×QÒk&ÇïYP¿uèåÇ¯}UaHV%G;ƒs¼”<A\0\\¼ÔPÑ\\Âœ&ÂªóV¦ğ\n£SUÃtíÅÇrŒêˆÆ2¤	l^íZ6˜ej…Á­³A·dó[İsÕ¶ˆJP”ªÊóˆÒŒŠ8è=»ƒ˜à6#Ë‚74*óŸ¨#eÈÀŞ!Õ7{Æ6“¿<oÍCª9v[–MôÅ-`Óõkö>lÙÚ´‹åIªƒHÚ3xú€›äw0t6¾Ã%MR%³½jhÚB˜<´\0ÉAQ<P<:šãu/¤;\\> Ë-¹„ÊˆÍÁQH\nv¡L+vÖÃ¦ì<ï\rèåvàöî¹\\* àÉçÓ´İ¢gŒnË©¸¹TĞ©2P•\r¨øß‹\"+z 8£ ¶:#€ÊèÃÎ2‹ºJ[i—‚£¨;z˜ûÑô¡rÊ3#¨Ù‰ :ãní\rã½ƒeÙpdİİ è2cˆê4²k¿Š£\rG•æE6_²ªÊØŞ‰b‹/Œ«HB%ò0ë¢>ÈÈğhoWÃnxlÖ æµƒCQ^€°ĞÔÿßñ\r„Š¾¶4lK{şZÆü:†ĞÜÃƒŸ.¦p¨§Ä‚éJóB-Å+B”´‘(ëTòŸ%®µJ›0ªlØT¶`+É-Á¾@BÚáÛ„Vá’Ä\0ÂÏC¼,ì¯0tâàŒF‡‰å?Ä Ë\na@ÉŒ>‚âZEC“ôO-æ›¤^Q€&ßÖù)I)®¤ÄÀR„]\r¡”9”7_ˆ¢\rÉF80µObù	€‘î>ºäı\nRı_ˆÑ8æ‚ØÙ«äov0¤bCA¸F!Ñt—–Äƒ%0”/‘zAYO(4«‹¡ˆ¨Ò	'Ÿ] Iéí8hHÂ05˜3ò@x&nˆ’|TÓ³³)`.“s6eY˜D¦z¸Œ®¥ƒJÑ“ô.„ñ{GEb¹Ó‹¡˜‹†2Õ×{\$**ı¾@İC-:zYHZIôà5F]¦²YúùCªOêAÂÚó`x'´.*9t'{ÿ(êšwP¶¾ Ñ=¢*‰†ú*üxwråÔ*c‚Ìc|„DŸ“ÚV—–\r†V.‡0âÆ™V¤dˆ?Ò€üê,EÍ`T¦É6Ûˆ-“Åì¾ÅÚT[Ñªz©‚.Ar±£Í€Pøºnƒc=aÔ9Fònß!ÙuáÎA©Şƒ0iPó¬”îºJ6eäT]VØ[\rXÌáaŸ–vkõ\n+EˆáÜ•*\0¶~¶Æù@g\"ÌNCI\$àÉŒƒ€êx@WÃy¼*vuDÙ\0ŞvœëŒ†V\0èV`Gç½uµE®Ö•ÂÁf“l˜h’@ï)0@šT•°7‹íÛÂ§RAÊÙ·ò´3Û˜Ğ«/QÇ]ª,sÖ{VR±¡öF«¡A˜„<¨v×¥î´%@9‚ÀF¢Õ5t‰%Ö+º/¢8;¾WÑäÚÇJïĞo:ÖNÿ`ø	•ÿš´hìÁ{Ü£•î ËÔ8ÔEuª&°W|É†„‰®Uú&\r\"ÔÁ»‰|-uÇ†…Në¶:nc²©fV­‹ÂÃè#U20å>\"®²Ç>Ì`œk]î-¯ÇxùSØÍ‡Ğ¢©‰‚êcâ¡óB’—}Ø&`ˆîr+E­“\$œyNıŒ±b,†´´Wx ş-9åÕrÓ,’ü`å+œïíËŠù’CœÓ)˜˜7Ûx\r¬şWµfMŒSR¼\\èz¦ÙQ²Ì“”uA¬ºê2±õ4îL&ËHi Âµ°²¹S\$)e³“æg rÈŒ©ƒ\$]ZëiYs¤õ×kW–n>µ7E1k8ĞdÃró®škÁı¢ëEŞÙÛwÂwcmTy¹•ë¿a›\$tx\rB´÷=Šö¢*”<Èƒ l¡fôKœ‘N/¶¼	ÃlÕáükH“õ8 .‘‘ù?f÷›Úÿã6†Ñ‡¼{gi/\"à@–K›ñ@2ãça|#,Z¤±‡	³ñwˆd¬™“²…¼å6w™^&Áêt™çœP±…¥Äù]À¼›.àãÚí¡TìîkroÀ‰÷\ro=—%æ×h`:\0á±‚ö«”|êŠ£«a“Ô®6*:ÍÓ*‡ÊrO-^–’ñén«Íó§MÆ}æ»÷ÆAya±İ\nƒu^ì–ÀrnO\r±»¡`şT~</ğ¶wÄyş}æ:›|£ÏĞûÖÌ¡6»¤×ø®Ÿvî\rc<·b#ûàô§†î–\$ùsµê|ç‡‡V)«h‹TCùñ(Ä½ñ£Ì]6¦Ş1´!1M±¸@a´/`Û>Ù¸üß£ğÕßÈÛC/ì6à´·#p@pá‘óÿ`Zÿôıchı°\0ïë\0oæ€ğ4OıOøi\0-\n«îÿ/ı\0£Dğ.ÿ ¾ˆ.“Ä\0fiŒÀÈ«£€˜\0Œ”IDüç\0§¬\rïı0f ßoãÿ€ÊGüˆğeJ|\r€¿ıl	¨3ê~ğiP›¦&“É¿/µ\09	^\0r•0]¯õ ¾Â›oõ.ı\"	°ĞÑM¥íğvÿP€ZĞÕmpËP°ùÚœĞŞ¹ïô{§†C?²Àk“Ï¼}ğ®şdöïÊ°~=‘.Ô- é	Ğm1>hûÏÛĞ•1;QI‘OPÈ\rºcßpApV«k\rQ*èQ}ÏçŸq>˜Ğu15BqQ[1fûñl«Â€apå¯ü\0Û‘*ŒJ©Q=ñÃ£Ù‘GÜäŠÕÁ±Ÿ±_ñ—ñbŒGHF.‚0Ôø	= 2P™Àó æòÏçP!ò#(3 \nÙ!1&72fª`Â/å\0°‡\"PÁUõ\$ñ\r0Ìğ,QrU&2fšÒ_²Xààò]ğ9\"’S'òƒ'²yğ8\r¨ú§òkW)Oõ)’*Ra%ã\\i—%ò‰&Ò³+r…’3ğS`…,ñvı¦&2×L–&Pu*›-ğ˜0\"Á%HÄ¬ÔïÏ@Ø“±°H‰B–P(ÃÉ\$p&ı,1MÂ ªØ­Ã®;\rnÁ.¯Ê I­.Õ',1ò)Ó4ı²å2°u+ó3æ `ÈSŠpL\nt§’_*²S3;6r'h35¤55äœ‹d2q+6ñ8‘O7sC\"pm8Ò­³“6³—9òm\n@e0É<8B8©<,( ¨8²Û\0è	Ó0šJÙ<@¦ĞI¤«ÀR6pÔ­mGË\"11¤6ËĞ.\"æÀ‚ï5Ì‚ûÇ:àÜ8bêA1±;ƒ';Â?<*\$È,³Ìo= òTÓÖ/3Û#«ºÒ†¬");} elseif ($_GET["file"] == "functions.js") {
        header("Content-Type: text/javascript; charset=utf-8");
        echo
        lzw_decompress("f:›ŒgCI¼Ü\n0›†S‘Øa9œÅS`°Çˆ“Œ&Ó(°Ên0˜†QIìÒf‰›\$±At^ sG²Étf6eŒ§yŒÊ()LäSÁÀP'…ÂáÌR'Ífq]\"˜s>	)â‘`œH2ŠEq9ˆÊ?ˆ*)‰”t'°Ï§Ø\n	\ræs<ŒPi2INÆ*(=2ÌgXá¸è.3™N„Y4èB<’L—üîi©Ì¥2İ´z=š0HøĞ'·êŒšÃuÆtt:œÂ¡Èêe¹]`pX9ŒŞo5šgòóIœÜ,2O4ãŞÑ…MÆS¸(ˆa…Š#¾Äàç’ïø|¹G‚bèôüxœ^Z[Çä™G¼ÎuTvª(Òm@Vò¸(†¼ÈbN<ŠÈ`æâXä1É+Œä9J8Â2\r£K¶9ğhå	 Áè`…‹ÆëI8ä›±S±ãt÷2ƒ+,£ÆIºã £pæ9aèØÅ< \\8Czôã\rŠ¨^òÈ]Ä1\\7C8_Ep^ÂĞÀéM1Àw\"'4fSX9ES|ä›…Ãk3ÄB@ÊæXa=No4t7ƒdD3µpŞÑàæ:)\\;° ĞÔğ\r)8HÔÅ44Pc=\nÔ!pdÇÕQN\rÌHï'ô¸š2¢#\"Õ¥m-¶b,Ç	ƒM.¡‰-IKÓ)ÀÉe'•\"ƒ´¤>2XÑÅ“eÄj:9^²1c„»È:YÉ@ËuËã“›4òXÇ& Ò|£)Ñ’´±-K‘xŒëªÂSğè1Óó\$â¡@\\…!x]\0Œ£ÕÎÀÂñ¤áF†COÄ:à1K‡Å*†F4aˆ»¼k˜úÈKÏš¾‘»ö2l¬pÌ3J<Èâ,2Øà8#ã †Õ\rŒÜášÜî ó¤h¬„·áF±Œİ‰2PëèŒŠl(È\$Ö°\nJÛ·-ŞÊÇ°cc~¹FÔîrøátbŞû½m{hğ.‡{ƒtkÛBµKc£z4ŒCª9…Û«~>ƒØúÈÚ`Æ“¹C Âs:âİÔ!cÅÙ®Úµ”*WÉHX:WÌ;Nà ¨j*/(á_p3ª¡HIãKlÉn!trã£Gã­º¤tCƒ	vƒ?mã¤£¾ Ÿ¢–\0CÙö¨§oÜ¥cbf6Işû'\ríbåÅ7h§`‚È9½iìd5’—taMè={É©ğ»`NoK‰	!d4ĞƒzWXdmH°š*€ÆÛS ]ÏĞ3&\0Ú°	d%A´-²…	Âì(„šÙùQĞ}ø‚èU!t7°ä‹†˜>x‹‘t{mY¹„0Ş@^±€\"Ñ=‡³Î@t\r¡°ÎÄ+Y§.¼·¼X¿\n«I'KTŸ€^(ìD.@öÜø++@¼3•ÒÔX‹	aEì!,Yéö2-432ÔŒõMOàÖI\$q%	Ä‹G¦X9™‡Â[R\0nÁĞ¸Â PŒJy\r òBÈp\\HÃpgSÉ¼±Faejk—.4¸†C.^ yi‘ˆ9‡PÄˆe\"Î”NY¬¢BHÃ#8ÑB1\"¶j\\Ú©x‡ğ#¾â@G 9†2¨Âf.ĞŒpsršTJ xÚk˜–È4KIlÈfù8z¤¥KÈ‡>AKñŸ¡n^’Ø=&ŒƒAÀ*?'³^%;ğî4Ü€³†Œ9¤Q’“hâN‡™>MÊ=['vHIİJ§‘“ÙvÆâ’RÊtƒó<Ÿ”Ò²Å^¢¼zÔÂ‰B^öhâ'µ‚É©Ğ)-'#”¤9JTÁ)Ø@jO!¨Úc,e˜j–¤–‡@H,‰ÂØjˆa™©vZŒ>­¡Ò·µ)E`\0\n‡áTPó8L<‰c•:F˜æ‰\$\nƒííœ†ÃÏCHm\"j‹y·AÛS¶ ÜSªQ„ğœÎÎ{T']WªUÚ)_L¥˜i¬mˆOš‚¥è„şÔP:g¡{¸’ZÄ—ø.ÿ{”¨‡Dh\n»ÑÁ‡a­\r]9¥tÜà!XA½[È°¦ã—Cœ»×\n:•”haœÎÚå\"İ¢a2Lmƒ·Í\\	ûëp5÷@ú«@m£ì|Wö•ÀÂ%È|u®áÈ+hKÃL&¢Ï Ş3ü.XWÜÙººÈñ*qƒÛcÃé‡%.K¿“€ÈA\r“xh¹â¨I\\ë¨d®Hº5\nÈq%Ôv*ÏãérIaÈ0Ê\"]8k,İÄAõŒ{Bç\\K/p<aëŸˆ1–0%–o2 ÏÃ™ªÁĞ%†Pò°@!ÊÔiµ9Ìçf1Ôù4ùŒ›àapØw¡`ÿAX¼upÁÑ½7ò\\Lº¡Ÿ°t¿„VÓÆ“a\$äWÒæèâãŸè:¹Èˆe}\rjC•X—º]ÚúÁ=m”¶•8Ëº\$‹ş·hÓ=¿K75±™RƒP°{rrŒ—,Ö_ëMzç%É§IZ—:ig”y%Hì5á½‚¤4QÀfØ¦ÇP÷¡lûş›hƒÅx³âê…‹vùX&¦\$sE¯úã0’äüé5•°íílW¤dÀ.DHŒ\$@š\r@&\rÁˆ9‡\0v¥7!çÈoÓ…ÎÃÁîÿ‰5áî)#XÈi]Îro¹~ÆËéwPêÂ›”QÛ=òàçqCíÇç×)«=ã#—@h'A˜tb;™Û0YDh'œ\nVW}(2†`VÄzv% tä\rÕ•ğe¨¸·—ì¾p.ë›ô¸“6H9¡=;n¡8C=¾	şù÷ıq€@a+¸Š†kÖ0aKá˜3Ep™×C +òA¿ÊEp®§C@>òX±ûâï'åL—ŸŠ{µƒXz´ĞoDÁ™%‡sP–W:[=ßv0’?ŞÜ·,%Àœ{\"í.á¨.YIôBğÜÂ	³\nWpVÂ)µ¾µqÉA£ÇM»V¼å5Ÿ÷IÿÙÇPıšÎ¿Ë¾ßè‰Á(ûb.¶\$ÇÕıò[ÒšÍjëÀ@¯êh\nF-4í8nj¬Õ+VMàxnj¾¦mb\$° ¨¬õª\n¶ÈÖ'¢~à¶ Z@º€¶ Vâº€L\"ã†p†Ø5€ğO,¨\0K¹\0Šª-6¥\r:”pÕDbÕnÕĞ\$¶mm\$i	)şO6(ÛĞAPIĞP+ĞVHpn¨§4?BàMğ¶·ãJF¾.öô€èá0Ğá+Ôi…jÇ Pş«(¯&æ»ãaŒÚ%l]'Üïì^@(œ5ƒN fs Ñcô bz ÃÏå>ïÂ¯x²°\0k éÄ\r<aXÌGé¨{\roL­ŒxÇ&Ï†Õ\$HjÄ¨1€Ü	¨<çl-Œú³\rËGKOÑ0•q+c	Pñj\r¤Ì¶ç­j‹‰Á‡½¯bdñ¢6¢Ç\0Ês‚à¢ñfÁ Ğ¶±z½Äj>«¤J°âıH®±'ââ3ê…(F¦Ñ‚ß¤Ğzª`O q¥ËX’`¶r\r ì1,ŸÏ¿gk lv­Ì|+°òækfì'ò=R@®4ë6Û`Ê-º.i~4ò#Å<\$²RÇ|u2N;Bn<’-#ì{%ˆˆû‰b=âå#Ìï(ÈJ1b%g¸¼ãz‹ü‹èG2«1^8wòòb^%/œ ï¾G­*ç 7D\0^‘rºc„p\n’ÎL,€ó0÷+ Xr§\$ Ê8ğ„×-)+(D‚ÓÀÔæàĞ\n„Á’b¬“©s1ìÓ2G\\{àÂ.I~`‡*³Îl]±“NÍÑ± X.#%\$KÀÁS'3ÌÓÌ6ƒ\$Cr‰C0Bô\rÓ--H|†“ˆ È†È,\"57Ó’´©Š˜îTÉó¥)în‰ÄíÄ¸íÃ/2÷LÄa7Ï2Kã1/d\"ÿ4SHïòæÍÔÍŒÜò¤Â1óª™\0O6R8|S|+©rÁÓ²œÓĞà¾\$O\re(Šà¨\r\"8‰ç­Ó‘s¦\r§©2ğÊ‘!*òmNTQòü»ø]jk+15ÓR hæ1óQ€z`pò¨R­E-SÒÒS\r1@vo.tÔTUFqEâĞ;g\\ç\"DQã`ä æ±sIÎv`¯ş0ó¥	+K€ÊpTŠ–)|„làñ¿ç8%'çLŸLJ@\r&+¨ òÔƒ²X“äÀÊå&åt¶á\\*'4ÇåNÆ£O\0·OTùDb\r1’ÕPL\0œ² ÉóºgMÄÌÅàÍ\"O>ÌŞÀC<tJôNº-:<àä™\"V]`¦/BŒğÕ*Ü§÷-£w<1f›MØüò’q±8œ-¢o¨~pKÀ×d‹	ğ¢Îñ\nñğ,4ÇWFÁ\$Æºnl\0Ù­ˆLš\n‰…®m®¸)Z€ÏZÉ†˜õ¦^@Î	 Â.Õíj×Dı]K` ú˜t\r¯Œ'\$^S'àO]éæSĞ´Ø“ô5ã ¤b%»\\ÕÀ\$‚L×Vau«Zï×U½]àÕà|EM†™•ß]ié]µÊ9¶1d	f.eP\r€à!Ås)Uj ñ¶W)\"ü&BSÅ•'Ã~Âvps	_'_fŒuT5G0ş5r<vzlàéhôrÕù¤YiqMD¸ıUqf¯Ôœ/êØä–;oó\rıTä¿ïş—`{\0rªÓ”\n¥‹U!ĞÕµÿ\"iï(‡£PãÄv¶ÈÒ¢Ìi0Úi°áOÜúòı¾²±// Â\rUÒr\"¥îQ Å\n\0Ö:ÀñEÆnÓk€Ê#~Ræ\"»en‹ èƒtJ„ã¶;·P	—Uu—Ctg¬ tLÀ‚8d\0@Ôl`w×~ —ƒxwŠ b	¨ŒJ æóƒvn\n€ , u;Ê×uuÅ.ğ V<o&|1ö×ÆQ|e/|ÀæHbQs·>w]7Ê70ã äãî ò!\"Ë4\0zWè2 DÆ\\W—<2\"ª€_ xwï|‡qJŒ&Âe‚·òæø24\"qX:d6ˆø+¢âã-Íƒ˜/ƒÑÈëâÓ„£[V7À1àß\rÇcÂĞ\n\0\n`©J ¸~+—'1f<m÷n¨V™u·pPD>!‚‰ÃG\0[a§™\r¨vî\0^\0ZK î¨~·&#ãŒ5€É…7¿w—‰%/‰Äî(à°¸˜¨FÔ¯?`»zÇ%vØjyøj‡\$w/—Ş!fqT,¶˜Ó‰Y7óI*jà¼F,ŸyRåK~r Ùrè’§_…Wí|x;`Üáâãƒnnù<'%xåÑ€³8‚ß€ í€b_€¢J å\" óh`Ev\\€Ëø#\"Ø<xY~>4Ù›ƒÉ–Ù„xdLÈûîFq9TlåjV#q-Ù=qÙD2MŞ‹˜ŠÆud+rTtgÁ“ÉÂcÂfn¢x¹^@™d<ùjy20±F\"ˆïÄ‹´‹‘sGpq¢h“*F­‚ Œ„Ïª„ÀY€â;9sŒ³™ìg½Ä\n‡ëL“QIS!ó¡'ìŞ‡ç#LÌ×Ân}BXZw<,Í¬d9 ­‚F€^\r1¨zõ®òYÙÙœcw;Ó@ly BªÂÀğ„fZ`Ş“úå@ù§‚I§Ú€Ÿl!¨qÈìñ¬#O£’usdŸ2ÉŒ Ê\n ¤	(œ\r¹dGF ª@ØÈÅÚİ®\0ß®E°1ÓßN3ø¼ÂtëÁYÇĞ%@u¨§U{¦mÆ=1ÀŞDBÍ>a&ÄÉÍ\nĞ×\0Bî|š¨:I+àĞ,³7'š8À¸à\\P®,\"ª-scÉsv÷œG£÷'Wš\$=}Ø[~ YŸycYi2sw³4\rKº.äP…U@èçœ\nAi2×Ù‚¹Y~'AmqˆÓšØ,4<šús˜sòò‰¬œ€È#Ì@Á`Xã\rÍ²³“Ñ1E=G4vG\0RÚ‚Ï×'’Y@7:Á¼Á@fPÁÌÊV{÷¿«!\"zÛô7M²o[ÄD!*–ÇWùÊ2j—2g8ñ¦Ÿ|L\$DÖiG}ìGRb!rî‚Ó&-3Ô£mõÈ™‚\r0÷qh1Ki,|ÈeÖ·zê—HôYF€dúiS3ë<ºc’ÊÍÇÕÀ“c£.nÀäiBx-r”v•ÅYJãÙN¼j!(“HfçÙîc„g) ó£%ÏCo[é(‘X‚G9ĞìŠB1İÎDG–¼•eL'8õe?]<O·#ĞèŠGTõ€b€XQ * àÃ\rpÁv¸»„\n<õ\$ûY\n:™±¸šmı`è@×Oë\0îUæ%ô5\0¸ `\0‚E}#M3!‹!GœtêwR¦BŞÙV¼“³œşûİ¹¦ÀIÜx=À¤şCÇÜ\"q^Ä\n€ŞåE-eáÔ#ìcì€²ÿıØVÒı;fX²<=Öı\0dO¯Şï–¼àò“á(®¥kŞ[\0ş(V¤YİƒÇÏş¨']¥‚åĞüWÎ°¿Ğ÷\rì}Íç,<h¯f@¦˜É	¬PŠ†3©;R£Õ¼\\ e‰‘×ÆŞ]äéb«²ÀW¯#Y¯zã®{äÃ®åÍyT¦»”â»™–¼ÑgCõëyû¹§]Òµ„?^©¢3@×Võ¾ÌÏ^Ò˜æ8—ËTèW>Íîb\rã>î]·»¬ÑÛÚ:ş—Ü~ôî=Î!}Ói'à]Ü¾2(ù\nFgª X©ºXn}â#Ü—œšñÒn`˜\rä?tñ XQÉ‘õLZny<îT\$cöá\\ç¹OĞ€îjîx)öÙLä–Cå×æ\$¯%^µï_')jîgŸèyŞî}tå{…<óÇÇ]ôG||©êS<bâ“ÇøèäÅë³&<Ÿ}Qè´÷Ø¥Wiw	å¿Ä ó1ë/Š\r%„1¥€xúÃ•? ÿˆi=3ò„‡…É`ëözI×Nêu×Z¡EÍ>~¨…´?ÇÎ¤n²ûïŞNr\0‚Ğ\$oj7Z& ª¶¹9S	tU`¢tc¸*¦Œ7s\rÅ|wç›•ÊNú<pO€Ø\"c˜©a¾7ËĞ\0€8<Í:ÄXy»vĞ& ’”µ Fnh\"ÃÉF €°npXºnDwÏ–qmhvIÚR„@­Á‹r%ZİâSFƒ¼Éæ‡*y°ª›®(Q¶åÅP(\nFlú1èA&pLƒ³Î ò|e¹<íW¡‚ü¬—á’eBƒÙ0F˜`m‹u°¹\nëÏXK–Š¥A™‚Å\\ÂºœËäNj}ïa@#d¨¢úf&\0ˆuÓå„*	DÈ ²Ñ“Çä(!	x×¡ÓÂä”ƒ·‚\$+Q5\n§5„o0³8\$-¡pX]B¢Ê…ü á‚A8bFĞK†D5ÂÂ˜#CVã9†Â'a´oĞÑ·E–©ˆüÓ™yˆíÄ†%0ZHŞh3»Q7'FI+Š·X88àrË\"\$9­Õ¤LÅ†¢‰ÿTóÜ.à=\"ÀB‰.NF˜LÂ”}Íœ @‘È¦¡,‰·…”èñfœlX‚ÜX·â`j˜’\$Ç‰@Cp©ašÀ.%ƒ’B€!4=`„*9|IâSâ¼¼ğåŠPT(}Sğö*C5oZ^Oî¶°½Ï\0ùş\"Ân˜Bpt‚h¡BRôn=\"€2OıŸJ!òSŒ±££!n‚d¦™\0–¿p _9ØÄ\n”ô\0‰AapÀD= Ã€ˆRGKeèC\0D+(¼ˆœ8Q[ŒÀòĞ@7QraÔ€×ˆØÑ(éïÁ(OÑç\0`548ÍÀ]0š&KƒFÁÎËÄGˆFÂ7 ]ÜlZ[°D1@\\xC¦6!^9@cyÒÄü&`¨\r0‘ÈmttÀçÁ6†::Aô˜ã³¢kÅò¨9nˆ²cFê%@/@mŒ ˆ£\r„ÈGº0Árn j¡\nİ†íÕ.b‡ÓÎ+â£ÈŞïív‰T•øä7	D\r…]CÉ&[@”Ü) )nˆa&[ã–é†~sØï©!˜¦0äşLZ”Ğ)¨AÁÔ\rw¤!Ç­\"ã‘À–*\$&?!õÚ.B°n\nHCH{I\"!qªı	A2J8=%\"ç½OĞ^q;Ù¦Å<+ €ó%³€™ÁfrdÔ¢=àˆÉ`Lg¨½ÆÕ‡Hè{‚K\0€ˆ/#¾’O1O9R–ú>)=\$Z'Ë€	a!#UºÈ•e^iaÚâ0‰-´à°‹Ê€Ë!ñëJDÏ`fd0ˆ)R¯H+¬×d¤I ´¢´6Afv’Û“x°TÃ{•™Cæ 1&GOº  \\¥EóxË(š•ê.nP\"(™02•ì®‡äædö„¢W²¿=Â.@¶gÀG['µ¥¦©jœŞZí2–Ì=İ'!«K5f‰)¬³R«¥(r1j\rX1i5Â\$”´ª	ŒÄ»”t,	oË\0p2Ø,m%¶uÙnõoS—ÀåÉ0PòJú\\6˜sÙãˆp)„jÄL?ûÖ²~’„9d<BùU¤AÄ¡BšP„H~ÈYĞ{-ÒE€Ó¸lCuÒ˜™¢ŒûÄ·*Ñ¡…™‘”\$r§°>é\rš-,@%ZŒfÂüâQY‘‰•,û¤pˆXRCiJ!3#Y nc|@	­Ìş(É²\"q±\nÌÿÆ_)1â˜!8 •\0¸Ñ‹`cC}(®_2 8M¥Y£ª‘ù^3.…U†à]!ÿÆë4ÉÃ€a“ˆ\n¨İg·‘ÕàJ‘ …¨€KĞ‹`9™Á³àLHÀŠÀ)ˆ X„Ïná00ÜŒS¤4EêP`Â+à¨	I4YÁFåXIÀØ9Áº„–h³WI JE9!†k#H]fï7<fm(´Q<@0Øà|&›¤'Ê@4Ø väÔÈ\0/‡ Aàâ»çê\"&«0yS<¡€'İ5UZÂqé%œ\"¯ç3 ª‰Rré‹Ip…:\0-‰PXT¬ùÃ\\\0NYÄI2\0£&ná;2g“|™û“ç9ÁÃN}ANPæ¬«\0>¤Á&T	DÿÀáÈ5†sb\",íèVSPĞ‡“2í‘€`	åĞÀ.eÇ@\\€RDƒw4\$(â’¢ ‹'b²2\0œ\$‚‡ØBf7°€¹ã¥Ü\"q%†WÖ@\0‚`E]BJ°SÅŠxo\r8Bªğ¨Šy(Ø\nèôÉÇÑôS¸”î‘ =@7UşA\r€{èü\$bc\n\\Õ\".h^\0`\"Ì^ãLôğ\0@9†¸W\0R•O­Ú`e˜ùş®N=©ìô8 ogv3ƒı–Ùn -¹ÿÖCùF•Åq!üB¨p-§êq‡ÿa¹£Óô7áÀMb'€sî§K'·MqÎÃH›ÀZĞ“†mò \$1IìOj™³5lkg¦şmzi‡•6A§§\\£@d,\n@Ó®‚4ñtæiJ‹\0®”l(<ƒP‰ÄeVAr¡’Lä*´„aáìáÀeQ\"ğ@´É)àûÂÍÈEÀQõÕ@yR%eJ\"4%[ Y©ºV\"[©3.+J²é=œ\0À |£LÑè×FÒ.\rÖ¤G„êzL€†Q°´nª8j‡=á\nÓğ!sÀ0İTƒôÔ4äf@ª±Y®ú\0…FÇª±Cj¾´…šÅ@{”©yô@È}0;€¡£ƒ8……8§¡)0 š‰à\\u^€N‘4qìçÿAœáåb:‹tâÛ‚ui%<ù7n¢í,]Õcªt>ék²«å“Š¶VË†ş¯\0ŠøOò¸iÈ­m(9štÊÛ‰ÊĞ…æA\0­fT•~\$¥S]”\\…d[9€ÊgÁ2‘\rpØB¶Ö x\0-È§‚ˆ”6¶eEA€á“1\"ºêã†y,‚+V]Ù”­²iñ™mt¤W[Bî<&µµ¸™`å«bmàÊÀqÚH|ˆfÀSZâÉ-?gËĞÄDãÀËOÄQƒ¯‰AVôŠóÎ¸E¿3ÅÌQ`T&×AÆ©\0\n%a\\ÊçS •ÑiÒ	'b®hHŸ^|}µO!Ì.ÉWæÂ!\$LµyĞ¸:¦İ»µÀ[:HD\0¿˜v•\0Ÿv*¬‹l{µ(.uÅ•ŠâR’äÃ•„¬Ztªm+lˆÑLY<‡+1œ!Ñ0€5/>ÙTÁ—:è˜Z6ä åIˆSÓóÇ¯Õ ?L‡«a,l›.¸=Ÿµ[±3tÕl¬öh­…Ê²Ì0XâhÈFâ§‚xPF³hÂ‚øú¸Vu0aÏ,ØŒÕ9\n`†n°TÅ¬«ëb7lÈ\$œM9Æ+Ldl®®6Y€5+Zµ°Ör®eşIñ	šqP‡äZáÛ¥ †ï40Ya­»¥E’Å°Û'5³pªùm«K`ŞØ¢|¥Ø\r©|âê\$œ‚ÍC­ÙKê¾ÒBx’¾åœRÕµÉÍm’tÄ8„ogIu1À¶·ZeĞ˜¦Ï“àœO%éıµ×MC™»Sƒ	nÛw¿İ§ÍAutì\$2{ğ6µX2Vñ'İ¼á/o[€\\]–û±ÛsŠ0«!”É%}xÜY7+Ü?aîåI‚[”#UÙ÷\0çc{Î2f÷*FÀàÚ2}Ó\0ıöÓb†m@ÌzdXà!TË”áMd&˜Û’I·8 ˆ£.‹tJd/ì©\0XÙû{ÉÂ¸Iî		K~¹^ä7C¹ @D&áµ]&SĞá•ÓCVÛ§Èd¦öšyDİæÕ—áÂ41\$Æ	‰‡F'à•\\2ëºÔÃîEt@ƒ}fAå»8.˜iK§6~å‹ïk•OİrËİòÆW['ÍÉ/FÉL`×J”ü8®ÍEğÚİ¦”vü¼VR²±%¢ê’¡´*É€ÑJÓ^rì„cH€È7töÆ:Ñn³7µÔmğx]è·ÑéÁÉ&ze)Ì5JÂtA®—›Ö«Æ)ÛZÛ‰£K%/âßàneÂ®¯|6ÃÎĞ÷É˜¥òÉc|Ô–\\>Û–K~Ô‚Û¾oÍ€à\0-¥Mli®··R¥ìd…B«|!ëO\$ó·¶=\$ÀY;z]½¤Ìa8p!ĞT\0.\r>(2—8¹±şi,’ÊX»W4ØZ¶²8¤­hë%Š”Z6¯ÁjDs³İßêÏ2èÅôM_\n´àÒ¤œ6¿Õ–RT”Q¨ÓYÅú¦Íş,`Fà/S\"Ó`nœHW¦y€!º€ê2à\"\\íê\0ë‚=6Ï6—Bˆ	ğ)\\-³UµÎ¹Œ¸Wp ¼)à}q!¥¬p\\ì\nRÿXlµ€µ°J-ƒŒ#¥ Sm=\\K†E1»#H©2	_Mmƒ.Hğ£Ò¥Œïo&!›Îƒå9ÛV¾¢'¶İìˆ+*U_¾¶ô«)L›.‹ˆ&Jì÷¡	pêÔ5kB¼Ø5ë†T,Mš\"7Q¡\"ëëúÒî\$aEŠ7):Å¢úñr…„…·:*.5|=áôúª–aë¦6‚À„8˜½€JZLivBx€‚æ òtŒ>¡øm¤Y9NŞ²ú\"4UŒbŠô,Çpº1·wP>¬ÛA–:n—WqâøhªRÆÆ;ÀZÿ\0®§b,=C‰p’\0îôë,½R^rk7ŸÈÆGô>MiVÂiÁ)Íİh9Áú+2J“Õ½!~³†4°èV4ç–®âl…²=áÓeàæº­Ö‰¾­,¬Õd‚òË#‡öZıi¢ÃYÅ¿äŠiH®ş#¢[™¨âJkÈ¶Ú­É•kKaˆóx\nèPT‚Ù²”ºµc8r~õ9d·O,Àâá DA^dìú™=?ŞOìï”5¯E˜5Oß²ÑjÅîç)‹j¯#Ò[ªúeM”İ¾Vi˜åaáq¹pú	Kˆ…t ²-9‹®Ê+ªÄ‹²Ì™ØYN¯¿˜˜6Ä\ròH[Å¹™K:€fQ\n¹—AJ]Û»eo™ ËñõòÒ¸—?Ë-”ÂËr:s)1ú¥lŠS+dFí†z×Î3µ²<k^6\0ØAeõîƒ8f²ifôj*r“fi&V>L©®zu¿'º3ĞI5™ëµk5Æ‘#¡la|@ŸçÌ—´lhÉò9‚C¦æ‹‘Í,•K,¬×&ní±B¸UzeÓø7ä\n:X@ğ¼ÿ¶I²Š\n¥<+‡\r—Ùç&˜mõÎf… £—[ŠdÖ++A¯3‘Dm7BµÑDÆ`‘9EÄh—(NÌ“kˆ†Û ®è:™U)1€àëµ™üçÄ'ùøØ\nL& \$8€EÀ…¤lÏDiêÁ¦hq%\"ôNcïI@íšŒŸ6|Peæ,{¾Â ı”¼Å›ˆÙæ¯fuÂĞ\"f(lŒ-œØĞ\\ºËP5ÇÊÔİóf‚|ÚækP\nÁËh(º¶„péÓ™Û&Nzb\r3ö*ğÖˆL{zÍu ›LeoPù˜Í²ÅV­z\nµ<Âã|ÍÄN1–lŞ‹)9åÉz*‹j#øh¦­)y˜_!‡g•¨ut!^ÈMyÁ\rj€¤4xÀºçêÒ´šÌ¢¹ƒ\"U]	X°j¿>µC›­r:§”w\n„öæ×­Å‰t`¥¤%!‚ÄCø£ë´zÈ\0^ŸJxaÒ4Éø–†.·…cÏX€mŠ<m@ª\0\"\n€E\0ÀŒÂ”óŸp–`hÎ=ÊM\n OÒÆ/d²ú¢‚Ú(¨¾ãú\"vF†Å‹Á¬È…+&Ä‡æ´¢%ßlq2K €èys5€îÖ[2p\0³Aú3	B7Æy»H3±´\\ˆøøÂê¯ÆÄŒ'0umœ\"âïQ‹î‚Ff±ˆ‹¼4Êw¸b6ñ>éU›Y¶Öö|×ûí€\r²¼HÉRö%©#N\$0ÿø0.øšæ·:Ş2ãO™í“Aºù&\02‚	óy<‘g€d¼(öÂAÒãÊÔˆ•¯áh:[Âß¸æÚnD ¡€¥¥cÀi˜İÀ91fSà÷4D8„±E*İ.éÇ¨û9‚€ëtÛˆ€Âv„¦í©CÍ2©æ\0bÙG š;®Üå@\0¼t°Zx£ÌÆ¢¶‘’¢©xÂixJ—‚Kµp:nıÓ€hëe-’t¹Ä\0·{\0)”vë­]½%nø*¢±Jß±2—|Ã+ónUòÁP¦2)íào`;ëj@F½‡€oo{¢é¶Nö\0[¾™o‘Ö[Ôß¨N7ÑÀ\rş\nS•ëÔüì‹jíûŠ|G˜—\\®g!mÔ €d(™g0a~×öbkãEŞ!·Œîo&z›ËÂÈWN–Àfj—Ì7İú«½‚îÜÒ[¹Û\nyØnğp3ˆNğ¹~ØwŸ¾â!ïI#\0vŞ®›–ªÎ­¤ëµòÈ>Ñ0a·pYñCÎ\0{À „IU€1âèƒÁà>ñ|ç˜4	æ\0W¿¢@o³QÛ\0„ºAnßˆüyßèöè.ÇhFPÛö±½\nx<\r¤Dàx}.BàÓhÛÇ\0Ê³!uBE´ä6Ÿ1¨ª¥ûUİ`®i“¶ü“¥9Á”Äå™†=Kmiß{?ÛHˆ½Ë­íwkâ>G)v¡-Ù¥Zó:m¡ç+C¨sğÔQàh\n¨[ÀWÀ)ª3™ÑÃ¯\n‘ì´H\0¿›îË\n©†9®\rîsd3|Ûh|â9½Îpó,¤ä^šŞõ¿£Ws´¶¤¦Õ£íÂŒC/³c\">AaNİhÒ0½	©¦€{8š”ˆBÈ‡„@0!tOÀ-\n„¯^¬°9€°j•¸Â/Nô7D˜\"€pHs¬½±q«^Ÿ“ÇÆ5NÇË¢ß	Ÿù¿É—p½ÙçWo¥yYrÁç‹Ó4ÎŠôı-Œš9SXÅ&À'CuÄaz~€d\nş7§éßÈûˆ?¦?±mnËvîKÒ¶ˆkòW§Çm+b ¦a9‹©À…\\Ñô/º~Ë¸İ¸—|‰t¯’›c«“ı±p%Fñ0}pz«\0Z5àÀœé=‚â qtÆöTU\"…¨€uÕîÍ<à .ªugW¹&¾Â¿ê“]ˆfÎ3ØÂ×™¯±ı9?h6m‹İöØõ\0tÅf‘Ä,]€½è\$€u^«ÑÓÓ-¤Å_¦ÄUê GÄóÔ¾—ğ%&éë™õi(ªÅ]æ0îkGr'z•—İÕ\$î?PûÀ~µKq\\*_gW2tè´È");} elseif ($_GET["file"] == "jush.js") {
        header("Content-Type: text/javascript; charset=utf-8");
        echo
        lzw_decompress("v0œF£©ÌĞ==˜ÎFS	ĞÊ_6MÆ³˜èèr:™E‡CI´Êo:C„”Xc‚\ræØ„J(:=ŸE†¦a28¡xğ¸?Ä'ƒi°SANN‘ùğxs…NBáÌVl0›ŒçS	œËUl(D|Ò„çÊP¦À>šE†ã©¶yHchäÂ-3Eb“å ¸b½ßpEÁpÿ9.Š˜Ì~\n?Kb±iw|È`Ç÷d.¼x8EN¦ã!”Í2™‡3©ˆá\r‡ÑYÌèy6GFmY8o7\n\r³0¤÷\0DbcÓ!¾Q7Ğ¨d8‹Áì~‘¬N)ùEĞ³`ôNsßğ`ÆS)ĞOé—·ç/º<xÆ9o»ÔåµÁì3n«®2»!r¼:;ã+Â9ˆCÈ¨®‰Ã\n<ñ`Èó¯bè\\š?`†4\r#`È<¯BeãB#¤N Üã\r.D`¬«jê4ÿpéar°øã¢º÷>ò8Ó\$Éc ¾1Écœ ¡c êİê{n7ÀÃ¡ƒAğNÊRLi\r1À¾ø!£(æjÂ´®+Âê62ÀXÊ8+Êâàä.\rÍÎôƒÎ!x¼åƒhù'ãâˆ6Sğ\0RïÔôñOÒ\n¼…1(W0…ãœÇ7qœë:NÃE:68n+äÕ´5_(®s \rã”ê‰/m6PÔ@ÃEQàÄ9\n¨V-‹Áó\"¦.:åJÏ8weÎq½|Ø‡³XĞ]µİY XÁeåzWâü 7âûZ1íhQfÙãu£jÑ4Z{p\\AUËJ<õ†káÁ@¼ÉÃà@„}&„ˆL7U°wuYhÔ2¸È@ûu  Pà7ËA†hèÌò°Ş3Ã›êçXEÍ…Zˆ]­lá@MplvÂ)æ ÁÁHW‘‘Ôy>Y-øYŸè/«›ªÁî hC [*‹ûFã­#~†!Ğ`ô\r#0PïCË—f ·¶¡îÃ\\î›¶‡É^Ã%B<\\½fˆŞ±ÅáĞİã&/¦O‚ğL\\jF¨jZ£1«\\:Æ´>N¹¯XaFÃAÀ³²ğÃØÍf…h{\"s\n×64‡ÜøÒ…¼?Ä8Ü^p\"ë°ñÈ¸\\Úe(¸PƒNµìq[g¸Árÿ&Â}PhÊà¡ÀWÙí*Şír_sËP‡hà¼àĞ\nÛËÃomõ¿¥Ãê—Ó#§¡.Á\0@épdW ²\$Òº°QÛ½Tl0† ¾ÃHdHë)š‡ÛÙÀ)PÓÜØHgàıUş„ªBèe\r†t:‡Õ\0)\"Åtô,´œ’ÛÇ[(DøO\nR8!†Æ¬ÖšğÜlAüV…¨4 hà£Sq<à@}ÃëÊgK±]®àè]â=90°'€åâøwA<‚ƒĞÑaÁ~€òWšæƒD|A´††2ÓXÙU2àéyÅŠŠ=¡p)«\0P	˜s€µn…3îr„f\0¢F…·ºvÒÌG®ÁI@é%¤”Ÿ+Àö_I`¶ÌôÅ\r.ƒ N²ºËKI…[”Ê–SJò©¾aUf›Szûƒ«M§ô„%¬·\"Q|9€¨Bc§aÁq\0©8Ÿ#Ò<a„³:z1Ufª·>îZ¹l‰‰¹ÓÀe5#U@iUGÂ‚™©n¨%Ò°s¦„Ë;gxL´pPš?BçŒÊQ\\—b„ÿé¾’Q„=7:¸¯İ¡Qº\r:ƒtì¥:y(Å ×\nÛd)¹ĞÒ\nÁX; ‹ìêCaA¬\ráİñŸP¨GHù!¡ ¢@È9\n\nAl~H úªV\nsªÉÕ«Æ¯ÕbBr£ªö„’­²ßû3ƒ\rP¿%¢Ñ„\r}b/‰Î‘\$“5§PëCä\"wÌB_çÉUÕgAtë¤ô…å¤…é^QÄåUÉÄÖj™Áí Bvhì¡„4‡)¹ã+ª)<–j^<Lóà4U* õBg ëĞæè*nÊ–è-ÿÜõÓ	9O\$´‰Ø·zyM™3„\\9Üè˜.oŠ¶šÌë¸E(iåàœÄÓ7	tßšé-&¢\nj!\rÀyœyàD1gğÒö]«ÜyRÔ7\"ğæ§·ƒˆ~ÀíàÜ)TZ0E9MåYZtXe!İf†@ç{È¬yl	8‡;¦ƒR{„ë8‡Ä®ÁeØ+ULñ'‚F²1ıøæ8PE5-	Ğ_!Ô7…ó [2‰JËÁ;‡HR²éÇ¹€8pç—²İ‡@™£0,Õ®psK0\r¿4”¢\$sJ¾Ã4ÉDZ©ÕI¢™'\$cL”R–MpY&ü½Íiçz3GÍzÒšJ%ÁÌPÜ-„[É/xç³T¾{p¶§z‹CÖvµ¥Ó:ƒV'\\–’KJa¨ÃMƒ&º°£Ó¾\"à²eo^Q+h^âĞiTğ1ªORäl«,5[İ˜\$¹·)¬ôNô\n«[Ğb÷ƒà|;‘éîp»74ÍÜ”Â¢¨ĞIŠCË\\ŞX°ç\n%øhØIäç4Ïg‹P:< ôõk¦1Q™+\\ÚÈ^å’ ™VèøCàòôWàÃ`83B-9F@ànÃT>»ŞÀÇ‰-–¿öÊ&âÜ`9q¦…Çßä‘“PÜy6Üå\r.yñ&£ñ´ÎaÌ‰ÍÃE8Ÿ0 êÀõkAÁ×VÛT7ñpïÆxØ)Ş¡~¤M½ûÎß!áEt§ĞùP\\èÄÏ—m~c½Bğ\\\nímŠv{µÎù9`G[·¾~xsLî\\±Iõ®ïâXwy\nà¨çu¯áÁ™S£c»¬€1?A¼*‡ùÍ{œã½ÿ´óÍ¿á|9Ş¾/–òş¯Eúï4æÊ/¿Wÿ[È³>–á]ÄrÊı¯v¹~B£ PB`T¡H>0¤BÒ)ğ >¸N!4\"‡À¦xW-ÅX)„0BhA0à½J2P@>ÈAA)„SÎôn¼ìnìO˜Q¢¬ÇÎÊb®rõÔÒ¦âöàøïhèí@È‹’î®(–ğ\nì†FìÂ˜ñÏ–øÆ™…(ìÎ³¤ÛP\0÷NÂõo}¯‚l«<ønŞø®ˆâîlëoq\0/Q\0of*Ê‘NÑ½P\r/îpA°Y\0p\\ãï~³ĞbĞLh °!Îã	ĞPöîd÷.¿ïy\no\0áÌËĞ¶öPptùP¡ovĞ‚kn¸\0z+æ›l6÷°©¬Êø0’äğ¹P½oF€NìÏFô¯OpıàN`ÜĞÖ\rogğá0}PÍ\n¬–@°”ö15\r±9\$M\r \\©\nggìÀÂ Ø\$Q	\r‘“Dd‰ÆÊ8\$¶ªkşDâjÖ¢Ô†ö&€ÓÀÊ ¶àbÑ¬˜ê°¿‰›	ñ=\n0ÊÕÀúºÀPØ ~Ø¬6eö½¬2%Íx\"pß@XŠ±~«æ’?¬Ñ†Zelf\0ÒZ), ,^Ê`ß\0è8&´ì¨Ù©‘Ñr€© ©ÃkFJÂÂP>VÆœÔp¨²8%2>ÂBmÎóØ@ä’G(²ä¨s\$ dÕÌœv†\"Èp°wÇÆ6§æ}(VÌKË ‚K¬L Â¾¤éÄWñöqú\r‘şÃÌ¤Ê€QòL%’PÔdJ¨¦HÀNxK:\n ¤	 †%fn‹ã³%ÒŒ¿DÌMü À[#¢T\r©ÀrÂ.¦LLè&W/>h6@êE ÈãLP‚vÆC’ß6O:Yh^mn6£n¼j>7`z`Ní\\Ùj\rgô\rÈi2I\$\"@¾[`Â¢hMı3q3d’ş\0ÖµÈúys\$`ÖDÀæ\$\0äQOf1ƒ&‚\"~0€¸`ø£\"@ZG¼)	Y:S¨ê†D.S%Íˆ’ Ğ3¾à d¹ÀmÓU5‹æ¬ó<£SÒSZ3â%r “ÎãÆ{óe3Cu6³o73î—³ÀdÀL\"àc7ÄLN ÜY Ê÷k‘>²‚Ç.æpäì2øQôĞ÷“¼åÓ3ÀVØ°WBğDtCq#C@½I”P÷DT_D´:ÔQ<”UF²=’1ô@\$‚‰6Â<cÆrÅf%Ô¬,|“27#w7ÌTq´6sşl-1cPÕmğqªÊ\n@ÊàŠ5\0P!`\\\r@Ş\"CÆ-\0RRˆtFH8µ|NíÆ-€Ædòg€‡Ò\rÀ¾)FÆ*h—`ö €CK4Ã1‹ÊkMKCRf@w4BßJÁ2\"äŒ´Ó\r1Q4É2,\"ô¤'¼êx§Œy—R‚%RÄ“SÓ5K”¦IFz	#XP‡>¨âf­É-WX\ršÜê¤pU´ÕDÔt&7@¶ÂÑô?’©ÀÑ ªµ£}O1½2†‡2Õ#UK*¤)ôê¸‹Œ0o<> ]Hš„Æ¿rè›LGNª›ê˜W%–™M^’Õ9X:ÕÉ¥N”òÕêÔséE¥­@xy’(HêÆ™Md×5<52B– ğ–k!>\r^J`‹IS N¡¥4'Æš*œ*`ø>€—`|¢0,™DJ£Fxbèµí4lTØ•û[¨§[é•\\‡¦¨Ô –\\{­Ò6\\Ş–’ öß(#mJÔ£,ı`©I³ûJ‚Õ­ÊÜèlß ûj…jÖŸ?Ö£kG»k¬T9ÀÛ]3ohuJ©ê¢®ÑW•\rkÕÏ)\0İ3Õ€@xè¹,³-Ê	5B”¡¶˜=ÂÔà£#–gf¢¡&Üß·Z`ä#ÄoíæXf È\r ìJhô˜“À´5rqnzõ§­sÁ,6’oÓtD´y‡äÂb´àhş—Ctn˜9n‘ í`§X&¨\r'tpL7²Î—¤&—¨¼l¬Z-Í¬w£{r—¤@iUzM¿{rx×—mÒSBÀ\r@Â H*BD.7¹(Â‘3XCV Ç<WÔÑƒİ|d‡q*@”ş@ŞÀÊ+xø÷Ì¼`á€Ï^™Ì˜ß¬__•ND­X\0Q_D]}tõYÅúp¦f€wÔÚ\"â3øz¦nÂ«MYñùZR\0÷¬Q¤?¸{†M3†•£*×1 ,¨\"Øg*U¡*²¯ˆÌ«zÒŒW5NV2O-|€¾ÉÓñ,×]‚B×dí\rŠñ/OâtÎøÃï‚Ì0‹xÆ†ğ½Ğ®OCë8Ş-0Ò\r”ÿ0à·õ„@]¤XÌŠĞÎğ\\\0¾0NÈï£Ñƒ4ëi¨;ƒØAtê¼8X—x¤\r†…Š“‘ìÁ‡øİŠ×Ê7¬<ö@SlÈ'LÒø9W ÊÎ¸òÏ¬ÖËì¢ÍÄ±•ùRçÌğÌ\r¾Ï ÂÏò|ÜXĞÖa÷ø7y€Ù\rwe¸Œù„Y!ƒ˜Eƒù’´šÂcRIdBOkË28[‡mÌJŒ+L ÈÅÙ¸OXpføÓ9ÑDÏ›·¦ßªw“@Ë“—Y—…¢Õ÷\\yäAcÙ£ƒXgš™%šôó’Â1“ï“j	œX†9Ccİ‡àR¡¹‡”QFÇpdÒ= C˜÷ıš\n\r¥Õ‘ÔóšdjÙ«’xE¡Â2FX§¢x_¢ØÅ£Ú5£™—}q¨Åí¿¤M%¦ZM™:\nÏzWšX7¥åí¦:ĞZi¢npY;ù>Ê˜í£ÙÉ†:6Ú;£ZÎX0ƒ“Ì¢#ùıcàMyU…i2,q¹FËšÈb­J @ÓgGè|4ógÈÒmzWõäÊ	¬)™Èr|àX`Sc‚Õ§ÀË™„óc—¥‡û!²B²—±”»/}{4JÂ\0ÒÃn»Kuz @ÌmÚÑ®€ß­yÍÒyÖ\"º)u¹ÊÂÙã¶Yç˜s·c¶yë‘¶š‡··y¼—¹7Á|·±|—Å{Ï˜*)°Ê4Y`Ïµ[v¹‡¤­‡û^NX•†¸‰†ò‡W”©û·‚7†;¾_‚‹*x™ˆ¹Ú\rùß¼ß‰xm+¾mû¨Ú™	´»¹‹\$\n¾l˜);™²„|Ù ßÚ™¡:œNÚ :„‚Š_È8N³¸Uœ5;¨p+U–L‡ò\\‡9í¦Ùñ“›¡»ıO:I’šû zQºœ¡ƒ¡TëšÜ)ªXG¡æ»ÅJ{w8“¾ûÅ‰¸UÆù\$ôàÃøü›PxTY¾pjh·¾J×Ã€›˜JÙ{‹Âğ@îÇ‚³ øğZ‡ÌÙs•¹hË˜ç–XÌ\0Û–lÓ–ÌàÌÈÎ¸Îçìó‚Y}˜Ÿ®ü^Ğ@u2ÀSÚ#U‰ˆ;Ãˆ|¼¼•¥¼™P\\ŸÊ#ùÊ|ª<®İ\\³À›JÛ‚,öœÀ•\\ÅÌšEÌú…‚]WÍlÁÎ,£ÍìÉ–<åÎŒÛ>YnÎ),Î™rÎüûÔ¼å—âº]Èı	ª\$õĞç½Íq„DJí=•Ù÷•XI-ğÅ€äÅÌa‡llÃµ]\\“w(iÜCÄ×ƒtƒ‘<i-u[uVDÖ“¸QÂ¸€xb€kæLI­.kú›@ŞÀ„ÜN‹“[ñ¼l<o=-]1`è”¼ªdš ÜMÌ7‡@Û%C=]ú›êÀ/|-àÜˆ¾ÉŞáqÃã•âíùâ*¾C¾òO~ÊQâòså`·ç(âòãDÉßÉ²¿à[ãşæ>Éká¾R™uéŞ\\+>)3íûPÊßP§Óí6ÓËM%º¡¾pÔŒœÅAĞ3qmu2ÖfzƒÛ¯ì4s‹	´í`Û‘ì°-kÊS%6\"IT5½‹~Òì\"™íÂUt_	TuvàÖ½ä¶Yw¤†­0I7¤’L‡\$ú¿1Mí?íe@3Ûq{,çÀÏó\"&Vi·àÔIŸ?¾µmõˆ™¯UWR¾´\"uiT‹‘uƒq­Ÿj\"•GÃËõßò(™ï-½‚Byîê5øcİõ?Œàwñ®°ëTúî’`ei¾½Jtb‰gğU‹3ËëÉå@öá~ê+¾Íï\0MïGè7`ùïÍ\0¢_Ô-ùñ?\rîVÿµ?øFOÔ6á`\no†ÏšInª¼*pà™öeÙí\"T{[Ğ“p^÷ä\nlh@l0[/ö„poóJKÖX“ñ€ü<ª=€9{Ç¾6ç–<eßAxãÀùÇ‚¼Éá4x[ÍLò“~>!åOQxš{ZVFÔ`½éÈ~Iß–“øL)Q[ëTûôM›àşT²*BC¤~	æâ‚ä\nƒò¡gÃˆÅ…p9zKÉ–ówzO9di^›'‰+¹ßïDz4ägHAº¯Lyô¡\nr€<IêjKQó¸Snô==\r.Âo7Â½Êé%a;‰kÏãmX¿›Zi%P¨iÏ\r­€¾ıµ/©…L`pR0¤&õ—I (Øá\\.£*m„*(ÚÖõ—\$ä†ÆÀ÷\nw×ŠĞ¥…8a“\n&´Â‘ÍUmª MÖ¨P+\"Ly„ó?¡M\n€2’	L\nbS ¥NäùÇr¶!w¥jw`¼Â\$îôƒráè…Êaáv±^Ãq­F‰Ü6•Ó¨i*™Ÿæ„ì_xõØ\n‰fğIê:B&ù6@É“KED¡úú·QD(V`.1\0Q\$íøF­¹H®’Tş€zĞ†‹Ì\rªjkzM€ĞÀ®Y™À(61€”x‘+®%dj¸Æo\nÂ¦¬\rg°ï\"ÉŒ´ˆ—?Œ1- 3hÏXÖÁ)åyjÃ5r¢N±#Q¾¼Š¸w{_ş¡øG)ÂÎÙ1i‹Ì íç¤<Z‹ºpX³¡Ö\$â?¥=%.´€Ò®&¾­%\\±8w­!¤µa4œ<JB[ĞÄº¦u4‡%êŠ×47‹Ä%gÑä&¸€Z(@	€E¢{@’Ğ#¥–2Šh@Œ#ñŸø™ÑŸ¥£@\$8\n\0UŒìjãA(×2ÀO€Š8Ú€5‘¸Œ¨@†ğ&'´\n€D\$i#À#Ÿt\n PTs#]P*	àDÌuc› PÀO|pc—øËP	Ş¼i#Ô}ˆæ:<ñí\0\0¥ÀˆÅ¥lo#}ÏFÜR‰Tp@„À'	`Q¬ycTp(ÆŠ@€eh\0‹˜Õ8\nrx› cş<`Nˆã:)DY\n*Dı‘2{dZ)A‹Ú4±²¤€cZLğ2ÈÊ<ñò\\Œ\$r#ˆşÆö7ñÁ¥°!û€´ü€Nª{O¼@\$<	Ñ¢ğVƒZÒÆ52.Aù#D0 \0´ÀI¸û\"P'H	²_)¼x@Š€*úàAOh£hI)I²L1¦’ìƒäµ%áJI‚B‘ş’g¤i\"p÷§K2}’ä–Å(CËÉÍ=²t”xCøĞ&FÄ	r“ÒoÙÉ@@'”ñ€%	 ÛHŞT±áˆ	ãÔ˜:=¾)\0.ñ°]Îâ5 .ğæõ(pÈÀL!à8­\0ˆ¹	éR\0L‹YaÔbkÔ°ˆ6Ä)Y·éˆî •Ô®£	h³zZ¦õ±’IgÎVO3oœ­Lgà3ËY2ãÛ‰ÜDoPË`3Ì¸ec-‰r7í‡2Ô—Dº‚Şç‘B¼‰Z•¼¼%å/I{MÃ\0pĞÀÌ.`äÊİo*•Ô¯%T€ı\0 &–iR\n™+Éo€ì©–\rÀ^2q”Ë©\0\\¨I@‚	KÀ#peC*!>€/á%|È…Ì’ÁŞüô\$è)çÀ§1P30(\r¢+\nZÆz„))\0*®\0kà€ÙÅ2¼–Ï…(–E86å¶s—tºf&”™Š¡´“+;”Ø76&ãK–_(›9fÓ,@-ÃÉ4l\$Û‚e7\0ù±:l“LİæM7.\0ˆ³|›ğo–JÛ©ÀÎZ³u•ÌºŠ'Èy{ÅH,#\0vU@9!¼¥	Ñ'†¨&„òGôøß@_-Ù¿³ºt;Üê¡:©µ€²u¡<—ˆL†iÙÎš_ê€Ø£@U6°Îù#ä_€L'~ùæ/Öm`\\Të']=Iäât°Ç¸Âà)ÔÏqùsÉ9Âa<RPÂº|tút&5°äs©lî@¾	ŞKÆwS®èlÍ:9úN®wSø|·göÉØOùAĞŸ<ë‰BÈ€\0/àz@´	ÍÏÁ•Òå†=?=iŞO‘kÓŸ=\0E@iâĞ\$B× hO\0Á>DÖP´ó‹UäçÑ†j¥HìÂ9F¬BcCi‰é­BwM§tÓx€PÀÙM‚?p“®=—äì8ÜÔı‘Ïlg~¨˜tÁa©€%]b\$àØ\rˆr„èÄa,6ÅtŒàW)\0U¨›F˜	|æì“¢ˆvh¦Qú*¥Oƒl.C\$À\\ ĞÖRRÌ<lcù™&Cj3Ñı%ôZM¨öÀz9GpY’â¹£\0i\$Dµ‡d‡ñzt[')[)Q¤ØêŞkÁpi0·#cÃ¾‹ôNE¨ô(ºC2L	Æ@9hÑEJ5Ò,šh{&Jzö0n€vª©>[€j“£Û[œ]ƒK•ıRîJë>.;ù¨íF=RÚŒ<råÓM¡=—Ô’¤ÜhØ^Y\\RmnËĞğ Nn*g‘¦ôÒÅB¬·5^QÒ‰@O¢°x¨¡HIÊT ´â9½)(‘œ&µ‡}A)PÊ\\/êô…_Õ!ÌH şÚ‘¥¤ù\0éBá­\$z4ÓTYu‚J’v\0êƒ”¨…%@æ32\0Sôm€--Gi@¸úQÅ%Ñj©Yİ+FuzlS—”ÜW3ØÅ·OrŠU\$EÔè;¹M©¢\\€Ô±Äu/£õjeQªš¦§,#J¡ªXPÔ<UH•TVVé#Uê™ÔUbˆOU´DZ‘â¢µ£Í8êÕUJuS «À‘g)XDZK‚•¢Bî\n¼@2Š©ìx@d&ü ½eÜ«Ià@ÊFwì¬8“©\$Ù'IºV‚V†U\$²ETÎ_ğ*ˆd¸/áFCÓYdp§vGƒ‰3‰ ‹Ñš‹L^(ù`áj”÷2S¸ºcÛW¨ÜJQYiÖHB”£ckœRè\nş²U\$jê\n„ZAi€î»¢U*wKDRxW‰LÂò­ˆ€+fÚŒ@ã¨A4¢àGz…R\n²5‚b¬\\_²Ÿ ­ô‡¡á0¼C@¤\$X\0+Å]¤ÑÂè\"?‡n¦€+QIj\n»x\r€ôB`S¸âM‚ÈÑûŠ\r o°@‚À6XÀ\"{±\0µãb ¯)–ÁM¨cMğW ä¶D_áÎ±Ğv@{cĞ:¤®%[%‰C²ş1¼Ù;AÆˆÌTn› \0º a²páóe~ÙU5 s©V†İe|M9‡€9 hË@æ¦\0êÙ~É@.³	l€· Jv]©ºD§f€7¨FÌá±³ËùŒ,/+:¾‹íÚXIi­\0U¢â@Nµá´\r Ê¢,².½i¶‡ª³m_ûFŒàÖõäÀYiUÔÓJ¯!©gûLj‹ãÑú¬D“iKAà6²õª-U«KfÖ_N€\0ö-3©ìÀã3+¥dãiûD	\"ö¯µM¥ml‹L…XÜãã¯¸Œ>‹&|UÕÑõ`Ïh¾ù2¦ÑĞn6İ…·ÉI+ØnÃ©-nDÃ×`„µ†®°É”°@ã¬B!;X™smÈ¯·†pC`‘p5Á°¬¡O‰%Z/Õè5”³é#CK`‚XˆªÂcb°Q#«§Qa»–…ƒ¸q…èpÚİ÷)™®G+~Û–ß÷\"ğlM_^zò©šæ!ÌÉàE«”Ğ¥’®šÀ‡ïa úØp86ì„åˆn+oì’Jâ¶ö¥¾,¹¡ó‡¢ºw\n¢]ÍƒpëŠÛRÁõ'§eÖJÕqµ'Ü¨%£'€nlO‹h@>NBÈŠX5,ˆ‡‹¢ÊrGr¹ Z l\r(ªË‘jIù†±lŸ¬%b‡;s+±× ¤Wg7¨)’*e…¸1µ•ŞÑ3“L e@(»p\0 ĞÃèds®AñÖD\0Ã\\bD§\nuê/&1¬ŞXR×¥Eæ¥‚5¡Tœ\r§}7õ§”ªîÔş”AÙ¬áÉkâ\\–øöÍµ´ŸÇqà2Ü€öZ-wo´“tßZùƒ‹¯]ó-yq2j+Õ†¾Õ­Ã«¬€n¾XA«Û\0†\0º¾+S•+ïY6_BúV7z®nZ@Ì†²Ô·Æ´]´-UMJc*¢ü¸´®í¢s\"ß+\0·ï¯x´B3^«öà0\r÷ÜÀÎïÁcğÖ\\jÆÆ*¬P-\\Q8ˆÊ·…l•cË%XşÉVB‡}‘,€ş;(‰`*Qú	\$áïÛrßÂ{ÁKøìCúÖ%¬\r¥ˆx	ŞøQû…,¶Ø¾¥×/‰vàä\" pÁã¶ğ~ Óáã ÅJ5eãü®Eš-^âX;c²\\©¶×¬m‹´7£?˜6C*åº®†,7®HfÄ/Â9eÌ0[@ñ¤!bê®íÅşUĞ‘=›Äi.Jocñj;ø—B³\0¼ƒï]Õ”ÑúvÙGÃÜ8àO\\\0ÀÇŠüO©›\$•.&	p‘\\‹H1bØpø’:F\"8Å¶…ş‰ŠøVx©ÅıµR®–xä=À3Æf1Š+|Ò»\0ÂBÀ¼kbÌPÇLÑ’£ô\$zÌáàÎc	¢ÇĞi,Pcb,pÃn(¥Æ,¸ì`'/»~êÙkÖµ‚Îp€q-›ÁÈ±¹VÀÜÜ†Ü\rÙ	\0á‘‹dSˆÓÈÚÍ+º\"Šéˆ­1\0(Ä-’Ì1~útcªşfı¸àBÛ‘b}Ø ’Ã0<1\r°¨¨L’€»\$¸ˆ2d\"1&ì™Æ€BÃ³N…Ô\ràB\rrƒ«\"?vädäZá±.\".\0?wä¼9€oÃà\rÄ0¥Ñœ!¢ÍdR€‚ë¤¶\0‘ÃÇHëÜra%ĞŠØ+\0yrƒH¾sÏ’4W#œ,\$èô \0„*xBó\nPÌòü|„ 8@/ \0ø2U’°ábíİè¢ÂÎÎªxÀ!¨d§°óúNÿ3SÔ?£ÑP»…€(òg\n8·‡ppŸˆü€S9õ@‘'  Ç\0úyµÿ\0¦y46¡H<‚öÌ×ô\n`S’ˆ…¼ÈûCY¹’„”³jp:\0N(ÓŒáX4ŒkÌÈÓgßDy‹<–n4™£ØrS<ÒÏıˆó¯?¥\nÀÇBãúf('™Ì~dgÓ™SËÏ?<³ÓVg(1™éãæƒ2ù£­—²)ÕôŸf`éZ€¼a“>t{ÀœÉŸô’>ñø\0ŠìPû`O¼\\sŒ<õ?4äwŞ~³ÜÇf@z™ÿÍ~hBW Ìø³á´ŠxhA¡¡ÜO'=úPÖŒ×²Üö±ë=óúc[ysèÌûgâ|¹‹Ïæ³%™Mè,Q³ÆÒ8'X hlUs®…§Ù¢ú é4ËÃqDıÂx*8g§NLšBÈ–¨;§}%eû@YìŸv ho!\$æ›NcCXì³@Ğ;YH'Á°@^ à·Rf^x„\0^osÜ_fª—“;¨Ópj]²:’Ô¤ïõ.mLêl\rš®V¨\0ó@Ü€¶Ê\"ÓÕÄ1%Œ!_êô@-]8f¤ç -Õş±äa]Y¯WšÏˆh`(‘¬äJë@…ÁÖ\rˆ—õ€Y	kB(€xÖÂ:5˜B\\QkO[:Õ0˜Â¼¡­uk›X¥\\×P\0ë[öx¹ÀÅ®`ŠRIGÕĞk5°ğª§YzÍ×PÒ™¬=†l=áõÖe€\0ç•2=k` Å[K¼‡Bê½Ìû8¶C±Í}k«c{#ÖØ¢„ølŸdfF.Ìµü-›AºÿÙ6º†K­’•¤ĞÖ×Pàv„'¢lHiAİÚ8C¶“®	G„`GbyÙ¾·Í- 0•Ä¬;[*_ˆ¡ãmlH{(;Uo¶ÕÑ*Ä]Š,Ä‹åŒÖÆÈşôXË“¡80Cµ°K	­!N¼õÔ(I`¨³	V¾Dv½§íšwá·rpc,ğåŒÃÓ\0ää 9~s»Xnã¦‡¢Ÿr[ec·4dçpÅi	\\…Èe2âãl±ÄaZCk»gl÷bB„™¶7x%¿êè½í€Å»Ùk`ì\nÁ(@Åº«®„5åİ˜¥Ï­cÌ‡#t›–Ü–éãE½}Å„sñ–Lvö÷E¹ï\nQQÛ”Şæú76}õ‹Or»çj§b¯%@7‹˜àÛµßh³wÍ¹÷n£kÙ`Víq·±Íòï³~›™ß~ø„4{Œßşå÷ë¾óË;òßï8p2mP+ dÖaX8&,=Òn›}ü!/øK&\rŠÿt´H™Ó)/øYÜ”†6@å¯=}ğŠğEU§lKÃü\\kÓb[×â1Gø®­M­)™J¨xXÚEïTä¾	/¸\"-‘ë…<4ßxDˆ¥ÅíĞpÄ(¼3ŞÊŸ·ß´'È+Û\$\r†¶<rí×n`H\\t\"ş¶70=ä·Y×Wéhsğ­\rÏw¼~°!ù0@6l‹\\† •§/şBò7’¼‰–ßÏ>Fÿ‘Ü‰\\¶¼RÙ¾-Çn‡€şÜ§\n¸?F~†œaŞ×+xÉÁıëñ¨\rœl,fúCß+­îw•i¢GøÛËî.X!¼_à71ymÌ~ñ„œDå¦È7åÊé	÷š¼ÆåîûÅGÍ¾gówƒàb/89¯ËxÑ@!R–9¸eÍJq˜Y¼hß'3¹ÏÍÄ¬*÷ñXw‹Ë®^—ÛË	¾7ŸÎî5óÀûåÖ`ö:î#È+Û­0˜·œS¯ˆ@0óo7:&~r(Z·‘G1zĞşˆ€·¢pİÎñdNŒï“£›`ç¿/Fz@8Ñt0ŠZÌ_ ‰ªÎ0³™{Úè¿Lén•‡×‡oEËÃÑâ=rû¡‚Gj]õ H•¥›²Ò·…»ŞAf+ªÈèVº•º­mœ7ıåßB‹ÛÓî*q‚ş}cãwØ³=Û„g¥»wE¢-H·°€»·¦½&Rh4—ªMêZÕ_L½©]WV'ÁÕ¦§Íñ\"uŒ@-ÜaMÃsº@9êL:ÈÕ’]ù#‚İaëoybİ\n\0[Øêrğp*}Qí‚bwßÛÓ¦?†ºâÿ;Vc¾Ê°›»	«.Ûsç´¢XíÖ°ûy·R=§&d”ã·rûO«çõ2Åj!Ïux¥ÜÎÔ§R{NÖ&øµÑ»®5ö„}£ßvyÛ°1o8Z#ş{ÛNärû½İÑï‡Q:BÕHzW{òïW{:ìrŞ÷ó¶}D\$§j7)àP€÷ëÁĞİCvV¬X—¾ıdí¨D7óá®€·¼,Ôh»÷á_ø]·^í—qÏƒÜŸxO»]­ïŠö¬?p{Æ\"ˆğOŠ8Qáµ?xw}ùJâ?9kâŞüx½5buÛ&÷øÏo›ÅÆ^ñ†õ¼Ÿ¬>õw“g]çíh¼#ä?+÷‹ mï(³¼¹àÿ/ngŒ	é5â5<ù;‡ñüòÈ…¼Ë³½œxÍ%‡³‘;ì(³ŞVóŸ–;Çço-ìóË½ëòÿ.eänkpËÂÀ_ËFäXõ9ÓWjQ¥ÓàCBØ§åv3R=°ì†¦;aÙ][yËÈ»4Ş/¢|óÃ##v	@_Ç­}UçM>ùßÌş1§»\rC£MúqƒCŞÄÆädÄ˜U#[ÓÉ¦Ÿm\n\\Ä\r6ô'Ï>‰ôÃiI;€R\0X€ç<rW0[ÀE°dHSèH\n^×\\”¥3ÂTû´ÀF÷xB™îÀ\$	Òi÷´-‚­'ûÛİÕ÷Xf¼}\0#É¤	1êo·BÆ€*;Û1±(\0ø~@)ü§Òh>³ª{³â~Ûøw·ÉH/vL\n9È?doÒÑğ°,‹x)#>˜#b`',úgTğ¤È~¯tˆ	€YĞ}Ùï°/]-'Òü\0¾(ØÈ şñ@Ï¡î/Ÿëä…>¶Š~ğolH‹âÜöÿ·½À/qû–DƒTúéö~¾¡o|ÓìaÉş°°#|F8ÍûdœÏ¥ò/±|“ì¿u÷¿€Vîâ©hø\n>Û÷ÿ°{´	Şõ÷ˆıçï_{şGâ IaùE½÷&{VNñod¡õÃFÆBÀXûï×½ÙñÀ(I¦N@Yû¿Çÿøÿ·ıÇğ9»üÉ¿\n-èû{çã@RıoÛ½Ù&‘o^3Y¹÷ï»>ğ¯†|”òŸø—îş-ñóö¶ùä~åı/»ò?*ù`\nÏú?—Sæ!VùŸîÏ©óœüïîÿ>ÎèÕ¸}ïãşOâŸ•ü¿Å>îıRMïûºƒõãø?b@\nOÚ?şà0¯s\0ˆ¢IèÏ€’ú+èà'¾’úX¯¦À,úƒò`'¾¦óê¯Ô?€úÓñ¯å\0‚Kà¯¸¬úCéO…À2út©>¨LO¬¾¢Lïv3ŠàúÒ\0ŠÎ[ï£PÎ›ïlë¬H\nhä²Îlr\$/Àı\0+½Øı\0	»£¨	©\r@ ?Kå)<#PøÓîïs\0ø ” ÂÎ?Kæ@Ì@\0ÃæÏê€±ø\0²%,p)?#£îïÄ\$ø\niL€¦¤°3è[Ìå3˜’“îğ?²¬ @Ï´O¼\0ªıö°A|P\0™ôD?²N@\$Á,£İ/ŞÀÿ€\$B?0ıÃø\0‚\$¯²\0Vú’LhÍ…¼ˆ	èé€ùŒ£é½Ê>¤#6ı+ù€>öR:p¾>«7#÷…½\\Ğ³lÎ“ãAoãüÉ<3lø	pe#7ÚA@)À±ğü¯Ü@ÒÔ#ıAV?hıãøƒ	0*ĞZ\0“°*Ğ\\AuƒüĞ_>kÃöĞb?>«ïÀ\"…½cæ©#6>ÒBÃö’Òü \"\0>Ü\0psÁÒ?ÛDPvA\\#şà(>Ò÷3EPŒ¿>ûÓ:­Â<\n´OÅ\0ˆüd\"ï@A\0ô°Aêûğ‘Áò”ğ”Â5ìŞÁÿ	“ø #¿‡	´ cş©	“ş€+´@ÃùhØ€ø÷¤€\$\0ø‹:M3nø’3cêŞ`ûèØÂ„ÑT+I8¿Bò3@*ÀÆĞø	@'Â”\\pM¤8Olòüøû¯†‚­»İM€Ÿcî#üÂíÄğ7B÷h`,	àâ6oŒÂ\\\\.S>¤›DÌÙCù˜ÿ0ŠË´ĞÆ£S\$2ÃòB‚ù«ù@&AŠ>ºLğkù¬4ÎAóÜ­3˜÷Ô°Ğ@½;öÍ>pùĞüÉ¤‡\r¨\n°3|Î\0\nO‹Aø:6ƒô\0¥d7à«@8ıœ%`#Ã‰ˆ[ĞÀ=ÚDåÀĞ\n°ıÌÜ3u’LãóC™¢9ÏBCÔ:`£‘\$!hÚ\$Ó“;ĞêB”20uÁ[¬8°ñC×	Ä<ôÃäúóç¯ŸÃëdPŠÃß|=q€2pí€V>˜û°áÃ÷	|*1\0Âç\rĞE\0©dAov´PÎt'?d,P­D*ü@	/Ÿ#6øÔCP‹BO\n¬©8Ä',5ÃÑüE€ ½ËLq\r?m¤Eq\nÂzşC@+¤är60åCê?3ß/¡Ì“ˆ\nPÜÙlHğ•D—ü¯Í¤5\nóü°°ÂÆãói)D°„1(ú£Dƒï£7ƒæÏu>Üà\nà\$Aæüj4Í\0˜?ê4Áª?”ÑLK	Aæ¢>Ï½?Œü‹û€ÀqDI@³£\$;ğ†D®8	 &¾?;°c€—ÄJØ£bÑPû¯ĞÅş\0	ğBÅ#3í`Â‚øˆ)ªÁ»ÌOĞ3CMZ50âEO6èÔC¯ì\0ÂÀŒ\\\$èÍÔûp[Ğ9BãíÁª#cj<‘1Ä1B;còÅDBhÔ?Ëô@`*€ƒ¬.qbÄĞøX	o?;\0KÜp¤3¥8	ĞRCÌú6/®¤—ˆ\$>lÍ¤pIÀª,!€*\0®+ÜÀ>=÷]±wÅã\nT^pgÅºú#ó\0?\$J@Ä	\0*CÈ*É7Æh\nñj?“ê:pArø”]Y€’ùÔL‹ËDbÑŒàúïBÑ4d@(Dä”ÌcÀEçÛâ@>\$Òà	4¾Ø‘şÑ†©</¶Ğ?\n€/Äº>¬gp>šŒü± ¤I6i8¾;³êÃèÆ‰cİ1¢AZ6€!Æ}<j±¤D¢¤jÉ(F’?dÀÂÅ'óêït\0†üTeÂØø´1– ú ü£şAv?lnos3˜’„50†#Æ>¼ÈòÂœ_¯«Ûd°©¿³¬UĞºÁZPú©4D|;Ğr£‘ÃCğñ€ˆø[9£ê¤¥ú5IÇ5²I‘É\0ûEOÜB\0{9q C‡|\"pUÇZÎPû` €²øı´GcœQCëGPúJO‹ñÂ6(ÚBïóÇz>Ú7ğÏFøöÈ0IÂ:¼vOŠÇ‘¢BÏuEäµ·,\\0Ç¸r8îÂÈûqgA6>ÀıÑ74D÷0qÇG¥ûêÍ>-SE@# ÑÈÎGÒ÷¤.à*\0i\n\\-`*\0q\n\\eñ½ÁÿØ±\"Â—Œ)qu¤ıÃï³nùô@`>DÔ8	\0/Ä@ş„_±Ú€¤üw#îÇlƒÒG‚>Ô„²¾-+ß6¿Wl%°6½·l0®\$5´sÔÅ&Œ\r *\0e!èrÇÿœ€qIÂ” \"ÀæÑ> È˜3EILÅ\"‹â‰94G\$/ñ¦\0—´‚©\0¯ Ñ-2>/„ƒìå€˜üèÓGg\nà/¿LŒq®BP€\"#7ôzñáHMÔ…O‹ÈO\0Ì &£¶2L‘ƒÁT^P@Zúd¨À=”]Q—=çÌKCïEã\0ŒQO¢Æ\\øôs0¤¤>ƒèq—Czù¬†±—G„>¤†²¿ü	ÌÄ@?Œ0Â?ü\\oÂ¿³–èø4Md1‰9€‰\0¼ÍGò?m\rDÆÑü(Ô´LdòÃ\\KJ8\rE’Ğù-24U 0VAÛ”…R=ÈEäe£ş¤5!Ì2m³qğüÏÓAEÛô²V\$ÆüÏ•ÉâŒØÅI9Óü‘	C&ù\\GÀ)D «ü§½òü4çIç#pú«#ÆøŒ—ññCˆù\\x£ø¿C(\$òƒHÍ:NI(J\0Î‹ß\"w\0¿,)PØÇ¬‹íÏ‹4<şÔ!ò=ŞúœGošÄó‹âP‡¿6üìN±QDë\r[;‹A|KÒ'AAäP\0¥C:šÊ„Ì‰Ñ4Åã*To‘†£ÕD˜F^ÈûÉ‘\$)Ï¢»¬\n«É’àÍ)’(Sà‰\0ò’È(ı\$:ä­@à‚²Y8’‹JĞà#ÅĞ‚ë+œ¯\nQ5ß+`a+ ¸iş`6xğ‘¤ª†è: ÚŒà.ĞT‚:‰şa˜\0øŸcv(ƒ^X¨€Â¼H˜O.\"JÊğO\rÎË>ex-¾¨J¸€èKPïû¤rÔ‚-`2²€ÜË_à7€Å-!\"JØô¶òİJêH.²ÚËo-ø.²İ\$ª<¸BOĞ€`> ©dáµ\nêH\"òØ†o+›“§s‚Øè 3ƒ‘+¢± ©6¿/¡ƒa.Ğ\r²ğ†nd»²ïË¨é’?ˆô£z1\0¥àğ‚?‰¨ 7€ˆâà<À?âãø\$Ó\n`+Aw*MQ¼Ã<Pıo¿°?,)#P>”àÂ€šøÌ„\0¦?jŒŞÄ“ÄVqÀ?“£ñ³\$¡	9¯õÆ-üÄ2ŒÌIÄĞîD9Ì³Lg1h[ÌÛÏ1ŒÄsC1sŞ©9Lz?à	 LWdÈovLŠş#ğĞ9`Í¨0æ€Ş‰É¦W·–ˆh>\0>¦¢Å/)Dáü²·Lº¢¡ÀÌÀ\$ÍaÀ†¨9*ƒ<:C+àJËìKPJ¸\"—L\\Ã*bÌò 1ÔÀä6ë4ja+\0î%Qf ;KœE¬¹ÀÔš`è> >7¦tÒHw€¾MPn3I:fàD <LÄÊRÈ'¾.\$ğíBO\\²\nû	Ğø5ã86ÄÌ¹D1‰<\r¼³\$Z…œğ’ƒ„ï4Š%rÌƒ¬²×àúÌş\$€ƒË¶§»éo™^Ú\\°È\0øf[z“e…í6|Ö“gŒ&ñ8+M=6È5ˆ³\0Ò1Idì{™^fqdè¶ˆs7(|©tM.]HSó[€ø¬Ô ÕÍ;7yC„—šÎ¸mÎÌŞI|A‚Ê:`c †Êß8\rÒ…iÔÉƒ¤ßÓ@¬‚P`È~\rlËa=M3ã€áf‰<ëÀRå\0Ï!ûÀ@’ØeØ«ríÍdO‘t ¬‰T°³-æXY9A“˜:38áOÊŞadĞ¥ö’gL³fxË=4K\n&€ôu0KòÍ¨Ç,ô³o7¤€ëÄ†Ó,à½Î3Ë:h|’ÎKbá)AN¬úÄ`ì€Ñ:ØÎŒ€×;´ €Í»*sI&”á«Rsµ>\rX\r!\0\nÀàBsVM63˜KâO×:Ä®ƒƒc5„× úÎæ‰X!AœQ9z%`º{:èHòºDëE€îcv!‚Î,Èôá“:Xƒ)¬(üº%˜Ë2a&Œ«,ğl3Ó8j1è|’Í‡É=CRrÍË<â\$ó\"KB3äöÁ'9…:|÷)`Oj+îÀ9	}-õSÒ>2¬ëUU5ÜôBUNàóô÷²ÑNÄäìS¾NÄüì«ÈO²äû3±KNìĞˆ†¨ ×@:/ç7£ÄQ†¨ç!Ô@.’(&v9ÔédÓøŒ^ş“‡’Ø¬!ï¦[.pGc K#?¸füĞpÃe“Oæçd®€2\0k6)„,\rÿ65GmOFV™dåiÈx,ÿa=O@s³şc6…`Â¤Ø\rJ\0å;‰³H†(ù*rÅ-Œ¾.íMÛ[ BÎ !(àóM¸LP«bUèÛpJÔ:î1úŞE“»¦º!:¢,ô:‚YB‚ò*KRŞ¤¾rÍ0Ø¬Lî“a6Å;6+2Æí)èUB`JsV0È:Ô0_B14/ÎúíAOáœNeúÈ)A~\rÚÈ öÃÌ –NPów“,È´C„î3œæ®¹ÌŞ°T3öq9}SQ\$ÄãA‚P“DĞ;!:À!îæ¸YŒĞsÄÎû6Ø“ÑÑRÔŒFt›#C¨Ï€øQ\\`rXr…<í'ò×72Ø¼´O-„w9Ó¤ùËb8à5€Å3{¡\0Ä7ø\ra\"ƒ\nh[j·ŸåFÛa)”Ñ+€2Ï<%’´M¢ê|®m¸|\nÀ54pˆş	&bUQ¨8\0EÑ¥4AAN,ËàìËFØ•To(ÉG`šO•GA›³êËGlı`:†=è\0<\0Ğëê”ƒ²ŒTÌNÏ¬=.û´ 6Î–(ûSBÄ°ô\0,Jğ?”.º(é†%“…,Ê?B.<2ğhMÎƒI`éÎŒá4ô¶*éË¯G°ëì'ÙI¸ÛíÊÑ9š¾ôRX—E%,O\r,Êˆs³Ï*•(”}<Ú—@c©öRœj]Dş`UR÷Î³,˜.²÷·d£¥rø¦’	\\·N•ÒÆl¸ÀØRÏ-ó“´µËšÜëkô·Q•K„½”¹,ƒIå.ÒíÒêšT·@1\0ÉK 4¼Òı/]04¾K›K\nC¨&•F,¶ô³SF0“ÔµS.-´ÉÊéKÅ2ÔÀRÏLe'ÀìÓ7L…0”ÏËoKõ3TËS.å4T‘:XÌ¾4‰Î9/:WRò9.Í62ôËËJ6ÀS	.ğc´¡Sv^ 0®»ËèO|L±MD%3î 4z3Id\n»ö•áú#tPq5h{!7Z‘Û»2 „ÆthÊ !îK€Ñ7Yİó1S³<»áh‹µ©½Ç-<ÎÍpÆø€jéÍÖà<4øÓ¹O˜%@‰OKBø°ôS¶!10Ô‡SÚÒëôõ‚YF…?UR4ÏÁ›ÓÜÇ!•õŒ~ÂXl´=¨ÇH|¶5QHıC&¸\"1M'µ8¯5a`Å?¢SPlõ`0—\\İmËÈTM,8'1eQaA&	\nÇTRèI¡ÑGÌ¿´ıÍZxôâ6yQÃ´ôñ¼aÀJÀ‹¼üûkU&ÿOXHá‚ÔphQEN†â=Cµ\"ˆLÉ›( ÚçQe@\0;ĞñQ®ÓPÔÅD\"€/—ú\rBà¼–tãµTì\r<eĞÔeS}Om¾—EP­P\rüÓ«P5B•4U\rR==õBSÏR}Hã“Tè#µE\0Îô¥U‚=QE‚J<ıSğ` Û‚¼1x\0ãU:óéOá/‚¼€+µN J`P!t8Õ\rT¥µ7 SõR58\nc>ÇÆºÈâ!ÊõŒ1{Ã€úÓ¼uE€ÚM4{Ö”4TŞíGa;|ğñà5\"SÎÕıNkSä8»DÄÔ?JcU0Õ¯RtB¸{ğ5qSåB„Ï,±\0ÆpĞàÔj†!‡\0006K¼1å ÂƒX@¦D¨V­å_ .Ô(¥_`-Öğ`ÆD¼àua .‹•X\rFÃÕöğõRõ…ĞFD½•‚S÷RxhÁª<mXjïb­ÖWù_G\nVšÄ©èS¸ï\00074Ù\0ÒLRÁ\$QíX›pˆÄÓğù ×ê\$°Nó¡Ö&83&a+²€|l³Õ‰ÏÉQsÀA£…CXšú]Î_X]‚\0á+8+UzƒsRPÎ¨Q\0Ü\08Õ™PóOİMU¶ÔH6!ªVX¤5†˜X…a¤ÇV/kÓVF”ı`‰TŸZ\0D5FÑOS½nákÖóTMSÕ¾U\rTMZÒºBğÍìoÓîÜEgÿWGµfµÅ„-YÁ(µ}V7T0BÀ©œ4Úğ’Âòƒ[9‘5ÖX´åm¯ÿXhét>×LU`4\nÍŒTÑõ††o9­vÓ×FÊUm®Ö\"ıu†DÕ€	\rw+Ö˜\r`©V(ıVÏãPËÆÓjô]Kâœ4°ìoT.\$mDÄµ¶	S’à‚­e@3ÿ×­;@7mŒ:Èë¥¥“´dğÈ!õâ¥Zğ£ôá»Q[œåõÑ5P•µ7;Sôº/BÖ!McÃG¹ÉT»Wõå(V–ÖÔòä¯•<7ó[lÓt…‡^Êô×ø\ri0ÁPÕĞÍa£|VX‰•áÌƒa[x9Hˆõ]¿õ¬^&m¹‚¼ƒÒ¤ù\0ÙXlã¤«Ìú•‚•Ş€»T‹ĞáOXl0£öØ(ô,Ï`€ØoaÈÕu€×ø3½‡U#Îô'0+Ó½8ñ]HT!XX\ryW@è¡\$ÛMQb¹‘-ä)ÓX	oõ†‚\n|Å`-qÎ-bÙ¶U‘VcŠÇÒÖ ‘3N=5vAg\rıŒÀ8<IGPBÔ9O^8.	Xk®ö;+\"Cµü×Z/åÂUUo[i`Ö\$×ïd].âÙ(s¼Ñå“ÔèÕ`-•Öâ½€óqªûe‘-ÂN¿=#[ÖMÙPè…ÅÑO^(B †”6ÍÏ_u–¶2:0mx ­Yg^5”-‘YG8”´AØİc¯VVßÉdô6Í\">\ra­è™^íÈĞ®0õ\"ä±¿R¤¬–,·3Dä¯Åøß¡2iGÈ5§Í?:\rT!ƒwg„óM[7;[v{ÖªCs\rU9d×`ØÈyh\0h@ØÈ~ŸqT4Ì×_QVÍvÃø•F5ÔPƒs*ÄMc]Ió9Ú1T0m†V)S•ÓXÖ[üâÍ*Œ¨c“dA+Œ1hóbõ:×IhõM@İs>P¬ÛÍŞ9ûvuTË>¥‚Ö½`	O5ÙccÛÍöjÏ?QëTmq\$¼¹—=(VÏ6F\rTr¶®~¥šÃ\0Ø|m•CÚ)[Õ‚N¨ÖÆ,dĞ+;µQm™-Å‡ğê\$µo²B-sšÚÇRˆ­ÕàN›:’È/8‰>øb.°Û40>‡ÆÚñ,‹.tÚºJ¶\rÛ\rk®•6Û	WMmØ3[Ñx5œËêqÕÉÑìLb´6Í;`•Lm‹ÿ4•Iµ6^d!5`7¤:aOÕh4õµÀĞ-3üÒHÈUm˜€¶Ú’³^_ÀÔNTê±²[PHğÙØa=UH\rE µ\rjM¶•”SåPsN6ºMXQ 5Œæ	Ã\r’Û­YKqsş[¾s-\0Öé®ï]¼aN³d5?ó+—Cf¼ÍÀRe^ø+@Ø[ÓP€5­ËĞGa‹öôÒµoM@w\0QyoKõUÛøe}¼Õ[¶_oK’@Ûán»wxVıpEºäùPuo5öR“ñ8c·.¥	Uo5Áw\0ò\n(%ÓNp¤ëVÖ®ˆJàˆ AqtÏ×Zæ#Õˆ³òÜk6””ÜiEÜØV‹R{qü×fØ{3l@äPqH‹r!VS]úÈ6¥Ú'q«Ğ@>R=E\0ùêSñ+UjõÊ”øYÓ[ÅºuUÕ¸Õ»rÌÜÇp»6Öõs]h'tË	mJ ¬8ñQUUuD’­m2z›Ğ„àˆB¡K”ßÜİv'P¿l]AAfËchÈ\"RåV«p´ÓXÌü;UË5öÜÆåÒcƒÖ°zPTuUQYëõíZ¯5åU¹…ıJen5ÀÜnŞÕovÅs=Hu½ÙÅZõoa‚itİoUÀÚ»uuH5nİ=jSĞÀUPZMNÄàˆÿQmobF·A>´]i\\¨G\rTŸvÏÖ‚Ôâ\"•Ä2Ø×v4Î³=]¶2åz\n=:¢\rh*s¯×fÅÓw_ÔäÊUt8Å[İ„8]Ÿ+=•ĞëGÕ×7z=n…Û—Jİòßuè8|«Å4u]ô	caÈİzà×€YwíÊt]ÜªÔÕáÅä^€ˆÎrÌŞ)w­]Œ%‚i,˜¦õí¤e}w—0<Õ3ÕäµnÛLr½å.³İiy-Ş7(K&‡\r_;f‰[­Ìˆ\\\rXÃ+Hï…çÔøa=Ü³bŞnôc€	,c’!£Õ8\$m“VõvRæJ]g -†W¹OsˆôƒR( êŞ5]WHVC\\5@Dİ!s%Î’²^×sdñ%NĞŞ9úÈ7·Öƒ{U™¡+ÜÙI-îÕ¼€ïP\0\"FĞˆS5…ÒFŞÏ[Òâµz¶Åsk(7ÄEz•Ÿ÷ÇÖ1-å@İxñÌ¹Ú>M³g‡ïWM£âjÔ»n\nÈ ƒ^«tLµ·ÓUc}AÃVRÜúõ™@;ÕX-<sÔ<×t…¹C8^!P}Ì3q´d·\\Î¶LÄ3uÀÖúÛû\\-\rSlX{sàLÅNlÙåïL™ßŸnà‹¶&ZÅpút6_[\r±¢°¬ƒVÅV÷è„C~ÈIªE…?W%üUöÜ«u…[ÓATAW\rü÷•¦\rdáwøßÅV½Ûkİù¶şÏh,8£ÅŠÏ”Üí×D×ÈØ»¦Ë­|añ¸6-_1O×Ã`j…ıo?7>\nÀXsôY‘nã^cÑÙ{jÈ7®ÚÄÚÊ:ÈÜ]E\"JVJe~×.ÙQHgT3r…cÆÙVßBceø“3e^Õ€…9®8¤\nò ™Zğ(ää‡ª½	;tæzôãÕ#	üq#à\0V.\nÂS/DkÈ");} else {
        header("Content-Type: image/gif");switch ($_GET["file"]) {case "plus.gif":echo "GIF89a\0\0\0001îîî\0\0€™™™\0\0\0!ù\0\0\0,\0\0\0\0\0\0!„©ËíMñÌ*)¾oú¯) q•¡eˆµî#ÄòLË\0;";
                break;case "cross.gif":echo "GIF89a\0\0\0001îîî\0\0€™™™\0\0\0!ù\0\0\0,\0\0\0\0\0\0#„©Ëí#\naÖFo~yÃ._wa”á1ç±JîGÂL×6]\0\0;";
                break;case "up.gif":echo "GIF89a\0\0\0001îîî\0\0€™™™\0\0\0!ù\0\0\0,\0\0\0\0\0\0 „©ËíMQN\nï}ôa8ŠyšaÅ¶®\0Çò\0;";
                break;case "down.gif":echo "GIF89a\0\0\0001îîî\0\0€™™™\0\0\0!ù\0\0\0,\0\0\0\0\0\0 „©ËíMñÌ*)¾[Wş\\¢ÇL&ÙœÆ¶•\0Çò\0;";
                break;case "arrow.gif":echo "GIF89a\0\n\0€\0\0€€€ÿÿÿ!ù\0\0\0,\0\0\0\0\0\n\0\0‚i–±‹”ªÓ²Ş»\0\0;";
                break;}}
    exit;}
function
connection() {global $g;return $g;}function
adminer() {global $c;return $c;}function
idf_unescape($Kc) {
    $id = substr($Kc, -1);return
    str_replace($id . $id, $id, substr($Kc, 1, -1));}function
escape_string($X) {
    return
    substr(q($X), 1, -1);}function
number($X) {
    return
    preg_replace('~[^0-9]+~', '', $X);}function
remove_slashes($Qe, $oc = false) {
    if (get_magic_quotes_gpc()) {while (list($z, $X) = each($Qe)) {foreach ($X as $bd => $W) {
        unset($Qe[$z][$bd]);if (is_array($W)) {$Qe[$z][stripslashes($bd)] = $W;
            $Qe[]                                                 = &$Qe[$z][stripslashes($bd)];} else {
            $Qe[$z][stripslashes($bd)] = ($oc ? $W : stripslashes($W));
        }
    }}}}function
bracket_escape($Kc, $_a = false) {
    static $pg = array(':' => ':1', ']' => ':2', '[' => ':3');return
    strtr($Kc, ($_a ? array_flip($pg) : $pg));}function
charset($g) {return (version_compare($g->server_info, "5.5.3") >= 0 ? "utf8mb4" : "utf8");}function
h($Jf) {
    return
    str_replace("\0", "&#0;", htmlspecialchars($Jf, ENT_QUOTES, 'utf-8'));}function
nbsp($Jf) {return (trim($Jf) != "" ? h($Jf) : "&nbsp;");}function
nl_br($Jf) {
    return
    str_replace("\n", "<br>", $Jf);}function
checkbox($F, $Y, $Na, $fd = "", $be = "", $Ra = "") {$K = "<input type='checkbox' name='$F' value='" . h($Y) . "'" . ($Na ? " checked" : "") . ($be ? ' onclick="' . h($be) . '"' : '') . ">";return ($fd != "" || $Ra ? "<label" . ($Ra ? " class='$Ra'" : "") . ">$K" . h($fd) . "</label>" : $K);}function
optionlist($fe, $uf = null, $Hg = false) {
    $K = "";foreach ($fe as $bd => $W) {
        $ge = array($bd => $W);if (is_array($W)) {$K .= '<optgroup label="' . h($bd) . '">';
            $ge = $W;}
        foreach ($ge as $z => $X) {
            $K .= '<option' . ($Hg || is_string($z) ? ' value="' . h($z) . '"' : '') . (($Hg || is_string($z) ? (string) $z : $X) === $uf ? ' selected' : '') . '>' . h($X);
        }
        if (is_array($W)) {
            $K .= '</optgroup>';
        }
    }
    return $K;}function
html_select($F, $fe, $Y = "", $ae = true) {
    if ($ae) {
        return "<select name='" . h($F) . "'" . (is_string($ae) ? ' onchange="' . h($ae) . '"' : "") . ">" . optionlist($fe, $Y) . "</select>";
    }

    $K = "";foreach ($fe as $z => $X) {
        $K .= "<label><input type='radio' name='" . h($F) . "' value='" . h($z) . "'" . ($z == $Y ? " checked" : "") . ">" . h($X) . "</label>";
    }
    return $K;}function
select_input($wa, $fe, $Y = "", $De = "") {return ($fe ? "<select$wa><option value=''>$De" . optionlist($fe, $Y, true) . "</select>" : "<input$wa size='10' value='" . h($Y) . "' placeholder='$De'>");}function
confirm() {return " onclick=\"return confirm('" . lang(0) . "');\"";}function
print_fieldset($Ic, $nd, $Pg = false, $be = "") {echo "<fieldset><legend><a href='#fieldset-$Ic' onclick=\"" . h($be) . "return !toggle('fieldset-$Ic');\">$nd</a></legend><div id='fieldset-$Ic'" . ($Pg ? "" : " class='hidden'") . ">\n";}function
bold($Ga, $Ra = "") {return ($Ga ? " class='active $Ra'" : ($Ra ? " class='$Ra'" : ""));}function
odd($K = ' class="odd"') {
    static $v = 0;if (!$K) {
        $v = -1;
    }
    return ($v++ % 2 ? $K : '');}function
js_escape($Jf) {
    return
    addcslashes($Jf, "\r\n'\\/");}function
json_row($z, $X = null) {
    static $pc = true;if ($pc) {
        echo "{";
    }
    if ($z != "") {
        echo ($pc ? "" : ",") . "\n\t\"" . addcslashes($z, "\r\n\"\\/") . '": ' . ($X !== null ? '"' . addcslashes($X, "\r\n\"\\/") . '"' : 'undefined');
        $pc = false;} else {
        echo "\n}\n";
        $pc = true;}}function
ini_bool($Oc) {$X = ini_get($Oc);return (preg_match('~^(on|true|yes)$~i', $X) || (int) $X);}function
sid() {
    static $K;if ($K === null) {
        $K = (SID && !($_COOKIE && ini_bool("session.use_cookies")));
    }
    return $K;}function
set_password($Mg, $O, $V, $_e) {$_SESSION["pwds"][$Mg][$O][$V] = ($_COOKIE["adminer_key"] && is_string($_e) ? array(encrypt_string($_e, $_COOKIE["adminer_key"])) : $_e);}function
get_password() {
    $K = get_session("pwds");if (is_array($K)) {
        $K = ($_COOKIE["adminer_key"] ? decrypt_string($K[0], $_COOKIE["adminer_key"]) : false);
    }
    return $K;}function
q($Jf) {global $g;return $g->quote($Jf);}function
get_vals($I, $d = 0) {
    global $g;
    $K = array();
    $J = $g->query($I);if (is_object($J)) {
        while ($L = $J->fetch_row()) {
            $K[] = $L[$d];
        }
    }
    return $K;}function
get_key_vals($I, $h = null, $fg = 0) {
    global $g;if (!is_object($h)) {
        $h = $g;
    }

    $K          = array();
    $h->timeout = $fg;
    $J          = $h->query($I);
    $h->timeout = 0;if (is_object($J)) {
        while ($L = $J->fetch_row()) {
            $K[$L[0]] = $L[1];
        }
    }
    return $K;}function
get_rows($I, $h = null, $m = "<p class='error'>") {
    global $g;
    $eb = (is_object($h) ? $h : $g);
    $K  = array();
    $J  = $eb->query($I);if (is_object($J)) {
        while ($L = $J->fetch_assoc()) {
            $K[] = $L;
        }
    } elseif (!$J && !is_object($h) && $m && defined("PAGE_HEADER")) {
        echo $m . error() . "\n";
    }
    return $K;}function
unique_array($L, $x) {
    foreach ($x as $w) {
        if (preg_match("~PRIMARY|UNIQUE~", $w["type"])) {$K = array();foreach ($w["columns"] as $z) {if (!isset($L[$z])) {
            continue
                2;
        }

            $K[$z] = $L[$z];}
            return $K;}}}function
escape_key($z) {
    if (preg_match('(^([\w(]+)(' . str_replace("_", ".*", preg_quote(idf_escape("_"))) . ')([ \w)]+)$)', $z, $C)) {
        return $C[1] . idf_escape(idf_unescape($C[2])) . $C[3];
    }
    return
    idf_escape($z);}function
where($Z, $o = array()) {
    global $g, $y;
    $K = array();foreach ((array) $Z["where"] as $z => $X) {
        $z   = bracket_escape($z, 1);
        $d   = escape_key($z);
        $K[] = $d . (($y == "sql" && preg_match('~^[0-9]*\\.[0-9]*$~', $X)) || $y == "mssql" ? " LIKE " . q(addcslashes($X, "%_\\")) : " = " . unconvert_field($o[$z], q($X)));if ($y == "sql" && preg_match('~char|text~', $o[$z]["type"]) && preg_match("~[^ -@]~", $X)) {
            $K[] = "$d = " . q($X) . " COLLATE " . charset($g) . "_bin";
        }
    }
    foreach ((array) $Z["null"] as $z) {
        $K[] = escape_key($z) . " IS NULL";
    }
    return
    implode(" AND ", $K);}function
where_check($X, $o = array()) {
    parse_str($X, $Ma);
    remove_slashes(array(&$Ma));return
    where($Ma, $o);}function
where_link($v, $d, $Y, $ce = "=") {return "&where%5B$v%5D%5Bcol%5D=" . urlencode($d) . "&where%5B$v%5D%5Bop%5D=" . urlencode(($Y !== null ? $ce : "IS NULL")) . "&where%5B$v%5D%5Bval%5D=" . urlencode($Y);}function
convert_fields($e, $o, $N = array()) {
    $K = "";foreach ($e as $z => $X) {
        if ($N && !in_array(idf_escape($z), $N)) {
            continue;
        }

        $ua = convert_field($o[$z]);if ($ua) {
            $K .= ", $ua AS " . idf_escape($z);
        }
    }
    return $K;}function
cookie($F, $Y, $qd = 2592000) {
    global $ba;
    $te = array($F, (preg_match("~\n~", $Y) ? "" : $Y), ($qd ? time() + $qd : 0), preg_replace('~\\?.*~', '', $_SERVER["REQUEST_URI"]), "", $ba);if (version_compare(PHP_VERSION, '5.2.0') >= 0) {
        $te[] = true;
    }
    return
    call_user_func_array('setcookie', $te);}function
restart_session() {
    if (!ini_bool("session.use_cookies")) {
        session_start();
    }
}function
stop_session() {
    if (!ini_bool("session.use_cookies")) {
        session_write_close();
    }
}function &get_session($z)
{return $_SESSION[$z][DRIVER][SERVER][$_GET["username"]];}function
set_session($z, $X) {$_SESSION[$z][DRIVER][SERVER][$_GET["username"]] = $X;}function
auth_url($Mg, $O, $V, $k = null) {
    global $Eb;
    preg_match('~([^?]*)\\??(.*)~', remove_from_uri(implode("|", array_keys($Eb)) . "|username|" . ($k !== null ? "db|" : "") . session_name()), $C);return "$C[1]?" . (sid() ? SID . "&" : "") . ($Mg != "server" || $O != "" ? urlencode($Mg) . "=" . urlencode($O) . "&" : "") . "username=" . urlencode($V) . ($k != "" ? "&db=" . urlencode($k) : "") . ($C[2] ? "&$C[2]" : "");}function
is_ajax() {return ($_SERVER["HTTP_X_REQUESTED_WITH"] == "XMLHttpRequest");}function
redirect($B, $D = null) {
    if ($D !== null) {restart_session();
        $_SESSION["messages"][preg_replace('~^[^?]*~', '', ($B !== null ? $B : $_SERVER["REQUEST_URI"]))][] = $D;}if ($B !== null) {
        if ($B == "") {
            $B = ".";
        }

        header("Location: $B");exit;}}function
query_redirect($I, $B, $D, $Ye = true, $cc = true, $ic = false, $eg = "") {
    global $g, $m, $c;if ($cc) {$Ff = microtime(true);
        $ic                            = !$g->query($I);
        $eg                            = format_time($Ff);}
    $Ef = "";if ($I) {
        $Ef = $c->messageQuery($I, $eg);
    }
    if ($ic) {
        $m = error() . $Ef;return
            false;}if ($Ye) {
        redirect($B, $D . $Ef);
    }
    return
        true;}function
queries($I) {
    global $g;static $Te = array();static $Ff;if (!$Ff) {
        $Ff = microtime(true);
    }
    if ($I === null) {
        return
        array(implode("\n", $Te), format_time($Ff));
    }

    $Te[] = (preg_match('~;$~', $I) ? "DELIMITER ;;\n$I;\nDELIMITER " : $I) . ";";return $g->query($I);}function
apply_queries($I, $S, $Yb = 'table') {
    foreach ($S as $Q) {
        if (!queries("$I " . $Yb($Q))) {
            return
                false;
        }
    }
    return
        true;}function
queries_redirect($B, $D, $Ye) {
    list($Te, $eg) = queries(null);return
    query_redirect($Te, $B, $D, $Ye, false, !$Ye, $eg);}function
format_time($Ff) {
    return
    lang(1, max(0, microtime(true) - $Ff));}function
remove_from_uri($se = "") {
    return
    substr(preg_replace("~(?<=[?&])($se" . (SID ? "" : "|" . session_name()) . ")=[^&]*&~", '', "$_SERVER[REQUEST_URI]&"), 0, -1);}function
pagination($G, $nb) {return " " . ($G == $nb ? $G + 1 : '<a href="' . h(remove_from_uri("page") . ($G ? "&page=$G" . ($_GET["next"] ? "&next=" . urlencode($_GET["next"]) : "") : "")) . '">' . ($G + 1) . "</a>");}function
get_file($z, $ub = false) {
    $mc = $_FILES[$z];if (!$mc) {
        return
            null;
    }
    foreach ($mc as $z => $X) {
        $mc[$z] = (array) $X;
    }

    $K = '';foreach ($mc["error"] as $z => $m) {
        if ($m) {
            return $m;
        }

        $F  = $mc["name"][$z];
        $mg = $mc["tmp_name"][$z];
        $fb = file_get_contents($ub && preg_match('~\\.gz$~', $F) ? "compress.zlib://$mg" : $mg);if ($ub) {
            $Ff = substr($fb, 0, 3);if (function_exists("iconv") && preg_match("~^\xFE\xFF|^\xFF\xFE~", $Ff, $ef)) {
                $fb = iconv("utf-16", "utf-8", $fb);
            } elseif ($Ff == "\xEF\xBB\xBF") {
                $fb = substr($fb, 3);
            }

            $K .= $fb . "\n\n";} else {
            $K .= $fb;
        }
    }
    return $K;}function
upload_error($m) {$_d = ($m == UPLOAD_ERR_INI_SIZE ? ini_get("upload_max_filesize") : 0);return ($m ? lang(2) . ($_d ? " " . lang(3, $_d) : "") : lang(4));}function
repeat_pattern($Be, $od) {
    return
    str_repeat("$Be{0,65535}", $od / 65535) . "$Be{0," . ($od % 65535) . "}";}function
is_utf8($X) {return (preg_match('~~u', $X) && !preg_match('~[\\0-\\x8\\xB\\xC\\xE-\\x1F]~', $X));}function
shorten_utf8($Jf, $od = 80, $Nf = "") {
    if (!preg_match("(^(" . repeat_pattern("[\t\r\n -\x{FFFF}]", $od) . ")($)?)u", $Jf, $C)) {
        preg_match("(^(" . repeat_pattern("[\t\r\n -~]", $od) . ")($)?)", $Jf, $C);
    }
    return
    h($C[1]) . $Nf . (isset($C[2]) ? "" : "<i>...</i>");}function
format_number($X) {
    return
    strtr(number_format($X, 0, ".", lang(5)), preg_split('~~u', lang(6), -1, PREG_SPLIT_NO_EMPTY));}function
friendly_url($X) {
    return
    preg_replace('~[^a-z0-9_]~i', '-', $X);}function
hidden_fields($Qe, $Lc = array()) {
    while (list($z, $X) = each($Qe)) {if (!in_array($z, $Lc)) {if (is_array($X)) {foreach ($X as $bd => $W) {
        $Qe[$z . "[$bd]"] = $W;
    }
    } else {
        echo '<input type="hidden" name="' . h($z) . '" value="' . h($X) . '">';
    }
    }}}function
hidden_fields_get() {echo (sid() ? '<input type="hidden" name="' . session_name() . '" value="' . h(session_id()) . '">' : ''), (SERVER !== null ? '<input type="hidden" name="' . DRIVER . '" value="' . h(SERVER) . '">' : ""), '<input type="hidden" name="username" value="' . h($_GET["username"]) . '">';}function
table_status1($Q, $jc = false) {$K = table_status($Q, $jc);return ($K ? $K : array("Name" => $Q));}function
column_foreign_keys($Q) {
    global $c;
    $K = array();foreach ($c->foreignKeys($Q) as $p) {
        foreach ($p["source"] as $X) {
            $K[$X][] = $p;
        }
    }
    return $K;}function
enum_input($U, $wa, $n, $Y, $Sb = null) {
    global $c;
    preg_match_all("~'((?:[^']|'')*)'~", $n["length"], $vd);
    $K = ($Sb !== null ? "<label><input type='$U'$wa value='$Sb'" . ((is_array($Y) ? in_array($Sb, $Y) : $Y === 0) ? " checked" : "") . "><i>" . lang(7) . "</i></label>" : "");foreach ($vd[1] as $v => $X) {
        $X  = stripcslashes(str_replace("''", "'", $X));
        $Na = (is_int($Y) ? $Y == $v + 1 : (is_array($Y) ? in_array($v + 1, $Y) : $Y === $X));
        $K .= " <label><input type='$U'$wa value='" . ($v + 1) . "'" . ($Na ? ' checked' : '') . '>' . h($c->editVal($X, $n)) . '</label>';}
    return $K;}function
input($n, $Y, $s) {
    global $g, $wg, $c, $y;
    $F = h(bracket_escape($n["field"]));
    echo "<td class='function'>";if (is_array($Y) && !$s) {
        $ta = array($Y);if (version_compare(PHP_VERSION, 5.4) >= 0) {
            $ta[] = JSON_PRETTY_PRINT;
        }

        $Y = call_user_func_array('json_encode', $ta);
        $s = "json";}
    $gf = ($y == "mssql" && $n["auto_increment"]);if ($gf && !$_POST["save"]) {
        $s = null;
    }

    $xc = (isset($_GET["select"]) || $gf ? array("orig" => lang(8)) : array()) + $c->editFunctions($n);
    $wa = " name='fields[$F]'";if ($n["type"] == "enum") {
        echo
        nbsp($xc[""]) . "<td>" . $c->editInput($_GET["edit"], $n, $wa, $Y);
    } else {
        $pc = 0;foreach ($xc as $z => $X) {
            if ($z === "" || !$X) {
                break;
            }

            $pc++;}
        $ae = ($pc ? " onchange=\"var f = this.form['function[" . h(js_escape(bracket_escape($n["field"]))) . "]']; if ($pc > f.selectedIndex) f.selectedIndex = $pc;\" onkeyup='keyupChange.call(this);'" : "");
        $wa .= $ae;
        $Cc = (in_array($s, $xc) || isset($xc[$s]));
        echo (count($xc) > 1 ? "<select name='function[$F]' onchange='functionChange(this);'" . on_help("getTarget(event).value.replace(/^SQL\$/, '')", 1) . ">" . optionlist($xc, $s === null || $Cc ? $s : "") . "</select>" : nbsp(reset($xc))) . '<td>';
        $Qc = $c->editInput($_GET["edit"], $n, $wa, $Y);if ($Qc != "") {
            echo $Qc;
        } elseif ($n["type"] == "set") {
            preg_match_all("~'((?:[^']|'')*)'~", $n["length"], $vd);foreach ($vd[1] as $v => $X) {$X = stripcslashes(str_replace("''", "'", $X));
                $Na                           = (is_int($Y) ? ($Y >> $v) & 1 : in_array($X, explode(",", $Y), true));
                echo " <label><input type='checkbox' name='fields[$F][$v]' value='" . (1 << $v) . "'" . ($Na ? ' checked' : '') . "$ae>" . h($c->editVal($X, $n)) . '</label>';}} elseif (preg_match('~blob|bytea|raw|file~', $n["type"]) && ini_bool("file_uploads")) {
            echo "<input type='file' name='fields-$F'$ae>";
        } elseif (($cg = preg_match('~text|lob~', $n["type"])) || preg_match("~\n~", $Y)) {
            if ($cg && $y != "sqlite") {
                $wa .= " cols='50' rows='12'";
            } else {
                $M = min(12, substr_count($Y, "\n") + 1);
                $wa .= " cols='30' rows='$M'" . ($M == 1 ? " style='height: 1.2em;'" : "");}
            echo "<textarea$wa>" . h($Y) . '</textarea>';} elseif ($s == "json") {
            echo "<textarea$wa cols='50' rows='12' class='jush-js'>" . h($Y) . '</textarea>';
        } else {
            $Bd = (!preg_match('~int~', $n["type"]) && preg_match('~^(\\d+)(,(\\d+))?$~', $n["length"], $C) ? ((preg_match("~binary~", $n["type"]) ? 2 : 1) * $C[1] + ($C[3] ? 1 : 0) + ($C[2] && !$n["unsigned"] ? 1 : 0)) : ($wg[$n["type"]] ? $wg[$n["type"]] + ($n["unsigned"] ? 0 : 1) : 0));if ($y == 'sql' && $g->server_info >= 5.6 && preg_match('~time~', $n["type"])) {
                $Bd += 7;
            }

            echo "<input" . ((!$Cc || $s === "") && preg_match('~(?<!o)int~', $n["type"]) ? " type='number'" : "") . " value='" . h($Y) . "'" . ($Bd ? " maxlength='$Bd'" : "") . (preg_match('~char|binary~', $n["type"]) && $Bd > 20 ? " size='40'" : "") . "$wa>";}}}function
process_input($n) {
    global $c;
    $Kc = bracket_escape($n["field"]);
    $s  = $_POST["function"][$Kc];
    $Y  = $_POST["fields"][$Kc];if ($n["type"] == "enum") {
        if ($Y == -1) {
            return
                false;
        }
        if ($Y == "") {
            return "NULL";
        }
        return +$Y;}if ($n["auto_increment"] && $Y == "") {
        return
            null;
    }
    if ($s == "orig") {
        return ($n["on_update"] == "CURRENT_TIMESTAMP" ? idf_escape($n["field"]) : false);
    }
    if ($s == "NULL") {
        return "NULL";
    }
    if ($n["type"] == "set") {
        return
        array_sum((array) $Y);
    }
    if ($s == "json") {
        $s = "";
        $Y = json_decode($Y, true);if (!is_array($Y)) {
            return
                false;
        }
        return $Y;}if (preg_match('~blob|bytea|raw|file~', $n["type"]) && ini_bool("file_uploads")) {
        $mc = get_file("fields-$Kc");if (!is_string($mc)) {
            return
                false;
        }
        return
        q($mc);}
    return $c->processInput($n, $Y, $s);}function
fields_from_edit() {
    global $l;
    $K = array();foreach ((array) $_POST["field_keys"] as $z => $X) {
        if ($X != "") {$X = bracket_escape($X);
            $_POST["function"][$X]        = $_POST["field_funs"][$z];
            $_POST["fields"][$X]          = $_POST["field_vals"][$z];}}
    foreach ((array) $_POST["fields"] as $z => $X) {
        $F     = bracket_escape($z, 1);
        $K[$F] = array("field" => $F, "privileges" => array("insert" => 1, "update" => 1), "null" => 1, "auto_increment" => ($z == $l->primary));}
    return $K;}function
search_tables() {
    global $c, $g;
    $_GET["where"][0]["op"]  = "LIKE %%";
    $_GET["where"][0]["val"] = $_POST["query"];
    $uc                      = false;foreach (table_status('', true) as $Q => $R) {
        $F = $c->tableName($R);if (isset($R["Engine"]) && $F != "" && (!$_POST["tables"] || in_array($Q, $_POST["tables"]))) {$J = $g->query("SELECT" . limit("1 FROM " . table($Q), " WHERE " . implode(" AND ", $c->selectSearchProcess(fields($Q), array())), 1));if (!$J || $J->fetch_row()) {if (!$uc) {echo "<ul>\n";
            $uc = true;}
            echo "<li>" . ($J ? "<a href='" . h(ME . "select=" . urlencode($Q) . "&where[0][op]=" . urlencode($_GET["where"][0]["op"]) . "&where[0][val]=" . urlencode($_GET["where"][0]["val"])) . "'>$F</a>\n" : "$F: <span class='error'>" . error() . "</span>\n");}}}
    echo ($uc ? "</ul>" : "<p class='message'>" . lang(9)) . "\n";}function
dump_headers($Jc, $Id = false) {
    global $c;
    $K  = $c->dumpHeaders($Jc, $Id);
    $qe = $_POST["output"];if ($qe != "text") {
        header("Content-Disposition: attachment; filename=" . $c->dumpFilename($Jc) . ".$K" . ($qe != "file" && !preg_match('~[^0-9a-z]~', $qe) ? ".$qe" : ""));
    }

    session_write_close();
    ob_flush();
    flush();return $K;}function
dump_csv($L) {
    foreach ($L as $z => $X) {
        if (preg_match("~[\"\n,;\t]~", $X) || $X === "") {
            $L[$z] = '"' . str_replace('"', '""', $X) . '"';
        }
    }
    echo
    implode(($_POST["format"] == "csv" ? "," : ($_POST["format"] == "tsv" ? "\t" : ";")), $L) . "\r\n";}function
apply_sql_function($s, $d) {return ($s ? ($s == "unixepoch" ? "DATETIME($d, '$s')" : ($s == "count distinct" ? "COUNT(DISTINCT " : strtoupper("$s(")) . "$d)") : $d);}function
get_temp_dir() {
    $K = ini_get("upload_tmp_dir");if (!$K) {if (function_exists('sys_get_temp_dir')) {
        $K = sys_get_temp_dir();
    } else {
        $nc = @tempnam("", "");if (!$nc) {
            return
                false;
        }

        $K = dirname($nc);
        unlink($nc);}}
    return $K;}function
password_file($i) {
    $nc = get_temp_dir() . "/adminer.key";
    $K  = @file_get_contents($nc);if ($K || !$i) {
        return $K;
    }

    $r = @fopen($nc, "w");if ($r) {
        chmod($nc, 0660);
        $K = rand_string();
        fwrite($r, $K);
        fclose($r);}
    return $K;}function
rand_string() {
    return
    md5(uniqid(mt_rand(), true));}function
select_value($X, $A, $n, $dg) {
    global $c, $ba;if (is_array($X)) {$K = "";foreach ($X as $bd => $W) {
        $K .= "<tr>" . ($X != array_values($X) ? "<th>" . h($bd) : "") . "<td>" . select_value($W, $A, $n, $dg);
    }
        return "<table cellspacing='0'>$K</table>";}if (!$A) {
        $A = $c->selectLink($X, $n);
    }
    if ($A === null) {
        if (is_mail($X)) {
            $A = "mailto:$X";
        }
        if ($Se = is_url($X)) {
            $A = (($Se == "http" && $ba) || preg_match('~WebKit~i', $_SERVER["HTTP_USER_AGENT"]) ? $X : "$Se://www.adminer.org/redirect/?url=" . urlencode($X));
        }
    }
    $K = $c->editVal($X, $n);if ($K !== null) {
        if ($K === "") {
            $K = "&nbsp;";
        } elseif (!is_utf8($K)) {
            $K = "\0";
        } elseif ($dg != "" && is_shortable($n)) {
            $K = shorten_utf8($K, max(0, +$dg));
        } else {
            $K = h($K);
        }
    }
    return $c->selectVal($K, $A, $n, $X);}function
is_mail($Pb) {
    $va = '[-a-z0-9!#$%&\'*+/=?^_`{|}~]';
    $Db = '[a-z0-9]([-a-z0-9]{0,61}[a-z0-9])';
    $Be = "$va+(\\.$va+)*@($Db?\\.)+$Db";return
    is_string($Pb) && preg_match("(^$Be(,\\s*$Be)*\$)i", $Pb);}function
is_url($Jf) {$Db = '[a-z0-9]([-a-z0-9]{0,61}[a-z0-9])';return (preg_match("~^(https?)://($Db?\\.)+$Db(:\\d+)?(/.*)?(\\?.*)?(#.*)?\$~i", $Jf, $C) ? strtolower($C[1]) : "");}function
is_shortable($n) {
    return
    preg_match('~char|text|lob|geometry|point|linestring|polygon|string~', $n["type"]);}function
count_rows($Q, $Z, $Wc, $u) {
    global $y;
    $I = " FROM " . table($Q) . ($Z ? " WHERE " . implode(" AND ", $Z) : "");return ($Wc && ($y == "sql" || count($u) == 1) ? "SELECT COUNT(DISTINCT " . implode(", ", $u) . ")$I" : "SELECT COUNT(*)" . ($Wc ? " FROM (SELECT 1$I$zc) x" : $I));}function
slow_query($I) {
    global $c, $T;
    $k  = $c->database();
    $fg = $c->queryTimeout();if (support("kill") && is_object($h = connect()) && ($k == "" || $h->select_db($k))) {
        $dd = $h->result("SELECT CONNECTION_ID()");
        echo '<script type="text/javascript">
var timeout = setTimeout(function () {
	ajax(\'', js_escape(ME), 'script=kill\', function () {
	}, \'token=', $T, '&kill=', $dd, '\');
}, ', 1000 * $fg, ');
</script>
';} else {
        $h = null;
    }

    ob_flush();
    flush();
    $K = @get_key_vals($I, $h, $fg);if ($h) {
        echo "<script type='text/javascript'>clearTimeout(timeout);</script>\n";
        ob_flush();
        flush();}
    return
    array_keys($K);}function
get_token() {$We = rand(1, 1e6);return ($We ^ $_SESSION["token"]) . ":$We";}function
verify_token() {list($T, $We) = explode(":", $_POST["token"]);return ($We ^ $_SESSION["token"]) == $T;}function
lzw_decompress($Da) {
    $_b = 256;
    $Ea = 8;
    $Ta = array();
    $hf = 0;
    $if = 0;for ($v = 0; $v < strlen($Da); $v++) {
        $hf = ($hf << 8) + ord($Da[$v]);
        $if += 8;if ($if >= $Ea) {
            $if -= $Ea;
            $Ta[] = $hf >> $if;
            $hf &= (1 << $if) - 1;
            $_b++;if ($_b >> $Ea) {
                $Ea++;
            }
        }}
    $zb = range("\0", "\xFF");
    $K  = "";foreach ($Ta as $v => $Sa) {
        $Ob = $zb[$Sa];if (!isset($Ob)) {
            $Ob = $Tg . $Tg[0];
        }

        $K .= $Ob;if ($v) {
            $zb[] = $Tg . $Ob[0];
        }

        $Tg = $Ob;}
    return $K;}function
on_help($Za, $Af = 0) {return " onmouseover='helpMouseover(this, event, " . h($Za) . ", $Af);' onmouseout='helpMouseout(this, event);'";}function
edit_form($b, $o, $L, $Dg) {
    global $c, $y, $T, $m;
    $Sf = $c->tableName(table_status1($b, true));
    page_header(($Dg ? lang(10) : lang(11)), $m, array("select" => array($b, $Sf)), $Sf);if ($L === false) {
        echo "<p class='error'>" . lang(12) . "\n";
    }

    echo '<form action="" method="post" enctype="multipart/form-data" id="form">
';if (!$o) {
        echo "<p class='error'>" . lang(13) . "\n";
    } else {
        echo "<table cellspacing='0' onkeydown='return editingKeydown(event);'>\n";foreach ($o as $F => $n) {
            echo "<tr><th>" . $c->fieldName($n);
            $vb = $_GET["set"][bracket_escape($F)];if ($vb === null) {
                $vb = $n["default"];if ($n["type"] == "bit" && preg_match("~^b'([01]*)'\$~", $vb, $ef)) {
                    $vb = $ef[1];
                }
            }
            $Y = ($L !== null ? ($L[$F] != "" && $y == "sql" && preg_match("~enum|set~", $n["type"]) ? (is_array($L[$F]) ? array_sum($L[$F]) : +$L[$F]) : $L[$F]) : (!$Dg && $n["auto_increment"] ? "" : (isset($_GET["select"]) ? false : $vb)));if (!$_POST["save"] && is_string($Y)) {
                $Y = $c->editVal($Y, $n);
            }

            $s = ($_POST["save"] ? (string) $_POST["function"][$F] : ($Dg && $n["on_update"] == "CURRENT_TIMESTAMP" ? "now" : ($Y === false ? null : ($Y !== null ? '' : 'NULL'))));if (preg_match("~time~", $n["type"]) && $Y == "CURRENT_TIMESTAMP") {
                $Y = "";
                $s = "now";}
            input($n, $Y, $s);
            echo "\n";}if (!support("table")) {
            echo "<tr>" . "<th><input name='field_keys[]' onkeyup='keyupChange.call(this);' onchange='fieldChange(this);' value=''>" . "<td class='function'>" . html_select("field_funs[]", $c->editFunctions(array("null" => isset($_GET["select"])))) . "<td><input name='field_vals[]'>" . "\n";
        }

        echo "</table>\n";}
    echo "<p>\n";if ($o) {
        echo "<input type='submit' value='" . lang(14) . "'>\n";if (!isset($_GET["select"])) {
            echo "<input type='submit' name='insert' value='" . ($Dg ? lang(15) . "' onclick='return !ajaxForm(this.form, \"" . lang(16) . '...", this)' : lang(17)) . "' title='Ctrl+Shift+Enter'>\n";
        }
    }
    echo ($Dg ? "<input type='submit' name='delete' value='" . lang(18) . "'" . confirm() . ">\n" : ($_POST || !$o ? "" : "<script type='text/javascript'>focus(document.getElementById('form').getElementsByTagName('td')[1].firstChild);</script>\n"));if (isset($_GET["select"])) {
        hidden_fields(array("check" => (array) $_POST["check"], "clone" => $_POST["clone"], "all" => $_POST["all"]));
    }

    echo '<input type="hidden" name="referer" value="', h(isset($_POST["referer"]) ? $_POST["referer"] : $_SERVER["HTTP_REFERER"]), '">
<input type="hidden" name="save" value="1">
<input type="hidden" name="token" value="', $T, '">
</form>
';}global $c, $g, $Eb, $Lb, $Vb, $m, $xc, $_c, $ba, $Pc, $y, $a, $hd, $Zd, $Ce, $Kf, $Dc, $T, $rg, $wg, $Cg, $fa;if (!$_SERVER["REQUEST_URI"]) {
    $_SERVER["REQUEST_URI"] = $_SERVER["ORIG_PATH_INFO"];
}
if (!strpos($_SERVER["REQUEST_URI"], '?') && $_SERVER["QUERY_STRING"] != "") {
    $_SERVER["REQUEST_URI"] .= "?$_SERVER[QUERY_STRING]";
}

$ba = $_SERVER["HTTPS"] && strcasecmp($_SERVER["HTTPS"], "off");@ini_set("session.use_trans_sid", false);
session_cache_limiter("");if (!defined("SID")) {
    session_name("adminer_sid");
    $te = array(0, preg_replace('~\\?.*~', '', $_SERVER["REQUEST_URI"]), "", $ba);if (version_compare(PHP_VERSION, '5.2.0') >= 0) {
        $te[] = true;
    }

    call_user_func_array('session_set_cookie_params', $te);
    session_start();}
remove_slashes(array(&$_GET, &$_POST, &$_COOKIE), $oc);if (get_magic_quotes_runtime()) {
    set_magic_quotes_runtime(false);
}
@set_time_limit(0);@ini_set("zend.ze1_compatibility_mode", false);@ini_set("precision", 20);
$hd = array('en' => 'English', 'ar' => 'Ø§Ù„Ø¹Ø±Ø¨ÙŠØ©', 'bn' => 'à¦¬à¦¾à¦‚à¦²à¦¾', 'ca' => 'CatalÃ ', 'cs' => 'ÄŒeÅ¡tina', 'da' => 'Dansk', 'de' => 'Deutsch', 'es' => 'EspaÃ±ol', 'et' => 'Eesti', 'fa' => 'ÙØ§Ø±Ø³ÛŒ', 'fr' => 'FranÃ§ais', 'hu' => 'Magyar', 'id' => 'Bahasa Indonesia', 'it' => 'Italiano', 'ja' => 'æ—¥æœ¬èª', 'ko' => 'í•œêµ­ì–´', 'lt' => 'LietuviÅ³', 'nl' => 'Nederlands', 'no' => 'Norsk', 'pl' => 'Polski', 'pt' => 'PortuguÃªs', 'pt-br' => 'PortuguÃªs (Brazil)', 'ro' => 'Limba RomÃ¢nÄƒ', 'ru' => 'Ğ ÑƒÑÑĞºĞ¸Ğ¹ ÑĞ·Ñ‹Ğº', 'sk' => 'SlovenÄina', 'sl' => 'Slovenski', 'sr' => 'Ğ¡Ñ€Ğ¿ÑĞºĞ¸', 'ta' => 'à®¤â€Œà®®à®¿à®´à¯', 'th' => 'à¸ à¸²à¸©à¸²à¹„à¸—à¸¢', 'tr' => 'TÃ¼rkÃ§e', 'uk' => 'Ğ£ĞºÑ€Ğ°Ñ—Ğ½ÑÑŒĞºĞ°', 'vi' => 'Tiáº¿ng Viá»‡t', 'zh' => 'ç®€ä½“ä¸­æ–‡', 'zh-tw' => 'ç¹é«”ä¸­æ–‡');function
get_lang() {global $a;return $a;}function
lang($Kc, $Qd = null) {
    if (is_string($Kc)) {$Fe = array_search($Kc, get_translations("en"));if ($Fe !== false) {
        $Kc = $Fe;
    }
    }
    global $a, $rg;
    $qg = ($rg[$Kc] ? $rg[$Kc] : $Kc);if (is_array($qg)) {
        $Fe = ($Qd == 1 ? 0 : ($a == 'cs' || $a == 'sk' ? ($Qd && $Qd < 5 ? 1 : 2) : ($a == 'fr' ? (!$Qd ? 0 : 1) : ($a == 'pl' ? ($Qd % 10 > 1 && $Qd % 10 < 5 && $Qd / 10 % 10 != 1 ? 1 : 2) : ($a == 'sl' ? ($Qd % 100 == 1 ? 0 : ($Qd % 100 == 2 ? 1 : ($Qd % 100 == 3 || $Qd % 100 == 4 ? 2 : 3))) : ($a == 'lt' ? ($Qd % 10 == 1 && $Qd % 100 != 11 ? 0 : ($Qd % 10 > 1 && $Qd / 10 % 10 != 1 ? 1 : 2)) : ($a == 'ru' || $a == 'sr' || $a == 'uk' ? ($Qd % 10 == 1 && $Qd % 100 != 11 ? 0 : ($Qd % 10 > 1 && $Qd % 10 < 5 && $Qd / 10 % 10 != 1 ? 1 : 2)) : 1)))))));
        $qg = $qg[$Fe];}
    $ta = func_get_args();
    array_shift($ta);
    $tc = str_replace("%d", "%s", $qg);if ($tc != $qg) {
        $ta[0] = format_number($Qd);
    }
    return
    vsprintf($tc, $ta);}function
switch_lang() {
    global $a, $hd;
    echo "<form action='' method='post'>\n<div id='lang'>", lang(19) . ": " . html_select("lang", $hd, $a, "this.form.submit();"), " <input type='submit' value='" . lang(20) . "' class='hidden'>\n", "<input type='hidden' name='token' value='" . get_token() . "'>\n";
    echo "</div>\n</form>\n";}if (isset($_POST["lang"]) && verify_token()) {
    cookie("adminer_lang", $_POST["lang"]);
    $_SESSION["lang"]         = $_POST["lang"];
    $_SESSION["translations"] = array();
    redirect(remove_from_uri());}
$a = "en";if (isset($hd[$_COOKIE["adminer_lang"]])) {
    cookie("adminer_lang", $_COOKIE["adminer_lang"]);
    $a = $_COOKIE["adminer_lang"];} elseif (isset($hd[$_SESSION["lang"]])) {
    $a = $_SESSION["lang"];
} else {
    $ka = array();
    preg_match_all('~([-a-z]+)(;q=([0-9.]+))?~', str_replace("_", "-", strtolower($_SERVER["HTTP_ACCEPT_LANGUAGE"])), $vd, PREG_SET_ORDER);foreach ($vd as $C) {
        $ka[$C[1]] = (isset($C[3]) ? $C[3] : 1);
    }

    arsort($ka);foreach ($ka as $z => $H) {
        if (isset($hd[$z])) {$a = $z;
            break;}
        $z = preg_replace('~-.*~', '', $z);if (!isset($ka[$z]) && isset($hd[$z])) {
            $a = $z;
            break;}}}
$rg = &$_SESSION["translations"];if ($_SESSION["translations_version"] != 3589914440) {
    $rg                               = array();
    $_SESSION["translations_version"] = 3589914440;}
function
get_translations($gd) {
    switch ($gd) {case "en":$f = "A9D“yÔ@s:ÀGà¡(¸ffƒ‚Š¦ã	ˆÙ:ÄS°Şa2\"1¦..L'ƒI´êm‘#Çs,†KƒšOP#IÌ@%9¥i4Èo2ÏÆó €Ë,9%ÀPÀb2£a¸àr\n2›NCÈ(Şr4™Í1C`(:Ebç9AÈi:‰&ã™”åy·ˆFó½ĞY‚ˆ\r´\n– 8ZÔS=\$Aœ†¤`Ñ=ËÜŒ²‚0Ê\nÒãdFé	ŒŞn:ZÎ°)­ãQŒµ™öú£°Ak¾ßÄê}äˆe‹çADÍéœêaÊÄ¯¶éyŠüs3-ì‡bmÓ”Î–ƒqŸ°L;+Y„åe#™Mş”¦y¨ØuìiË¤¿\"\0(#˜æ;¬ã#²Î\"°+N&\rëPİ¯Ãkz2¶=	?h¸Æ¦³k‹P40ˆ;Æ:ÃèKN Œèä2c(îE‘sB‹4âtdß³£jŒCË:„²„¤Ã£,>Ã¨İ-{° Œã:3³’Œ&)Œ¯pÆ4Mèò;óÂ³¯#\"’1Ã»Êå¥­°¨âÃPÀÎ:L ×Éƒªe§˜ÆŞµˆ˜5Ãl,ÖFƒ«0½ŒhÀØ,Ã„0m4i¯ÁCºq­;AL°°! .Ú/¬#¸ŒPuWRÕÂƒ\$ÊIJÅ4B(ğ8W•DºÎĞ\r=?Xºkì<¼Å¯óƒ=ÈŞ3ÃbÖÑ¹pŠ\n¼Šƒz5E(ÚùM0Í?CP‹€2ïzE,-møÜŸ¤#kdÎ…ÀM»oÌW1Ü£Î6]0çv>·xÃxŞ2(A{\rÔr’”/c°Ãk\$\"¦)Ì¸Ş5ÃpA.7ÓÂ3,éƒ¡…ÉD 3Ûh=È¤àSóIšKJu~4 #%ØË«îxåkZP•?1xáÀğNt8g‰®D\$cB3¡Ğ:ƒ€t…ã¾Ä\$‚ü,ã8_mcÃ:¾KAxDĞL¨é¬‹è³z5„Aõu Rc xŒ!ò~Ÿ>‘#½~dã!\nÂí†og(@á`8Ir¢:Êr)‰CâÃœ´·5ö’!“f\\¼Ğš„€(g[M)B€¤H\nE‹\$Í(7bØÅÃ\r.Ã%Ib\\˜b#k­ÚiŠgØ\$®@ÈŸ)óbk©v(½dµÒ:\n bˆ‚ƒ.é\n–¦¯¹+>Ÿ #‹gÍŒÌ` Œ›4^É—˜c#Í	<–eIBûs…¥Ø„ğ¦òdAHš¢ƒ<Q` ,ëÉò«'XPA¯\$§89%“^§šŠP1¤¡g¨ƒzfHñ \$P,3²5I\n*0\r\$Œ#GhwMú»8Eà’?¢:L,á”´¯6@~\0Q®&P™	„ğœ¨P*P\0D¡0\"ÅÕNÃa/^hÓ HJ}ìlAP<©c–“Ä_,ihìpÌSñMx¦Î3¨§’#î8¤¤7š¢9#\rQGèN\nÙiØ«\r\$…c âPv•‚'Æ,Õd0§Œ—jI%ÁBtÖª8ŞW*Ú`Ø\n= (+èvÁâ3ÔìBúíÃp:pæ]«PÎ‹³v®•œ”²•]‚™SZ\n?’’˜h\r‘R9š)‚N<á,LJVÔ%L¼\r(Êr£ˆÏCj/i¨<\$…D‹Ë\\üIL‚‡\$Ù9[¨e/3şDh—AOe¢l\$§\"Wii2§ø(9ˆ†V°n\rq}Gƒ’/!Im­s°Li°¨1Sª•‰1ò½F€/7ì_‹+à˜#‘		ƒ0 ((›5ÜSÒS\$!<%®ÆR‰ÔIS¹|ÔÚ€ÎªŒîR«T“Oƒ\rZCò¬À¨•öØõ`lH”0êSçís¬UQ|×j<ŞåyªUŒ%—[rBö)µ(ìBpG!Š\n±Ä\nÈúà´aB™t#ú‚¸eVyN“wÎv’N‡\\Ôá—™~§ˆšğØ¸m‘g; ô–rÊßş.Ñ‹–Ğ’LRs–S¦£“*î9a¹\$úS/28ˆn‚=„.ê\\Åæpõ\\¤âî\\»›*T³¡¼d\nòİRb‹¥XT4WNó@m|oœrNË\\ì†Xÿ Qƒ~è÷c	Ò/åâ>`¬Îc”½*äÖU	Fi¯­ïL×ª}”ğA#´áŸÌsÊIn(\nPKké{ƒ%è•xµd^Ë•{ˆl½XÑY^Û¼ñÖ3A˜×ãö/|/T±X’vX\\PKr×È²A“\"kYj4´­!š­µ ”\r‰ÄÊpâåué–kEj¼A‡†xœW>¼á¾U^¬Ø@h„OÌxi”<Û›ó7ÇğvñPB›\rYŞ=ÍÚâ71\nl¤‚äÁ‚âeã¨ea	•ß9¢šça}ÃĞÖSb”j­ù«¦dìûÒèôçìñ›¨p¡1XZÀ†bÏ*+£¦|Ï\$wœ—GÃd +O9i²%Ft½;3gg½	*òQF(Î˜<œ÷Œv”«Û¨ghl¬ú¯i‘ĞYRûŞ©şS·M5È;ÂCÌ\"ş¯Tfİ=ñ~\0Ÿ6×™‘)1#'ÒÜÅ´7u%ƒ)nU9¹øgİwÛ îîIr{B{¼È†ôØVòUK'ğD±8ïä0P:•æY#°T¢”ooã+ÕÌ¨ÒáÙ\"ó>uÄòÛâÈØñó“ı¶hÍd´Óî2òN5Ü7«¨sû»)÷4«ê¨¿hm{Ô*eA\\DÓ„xJ¥  vcæ‡r–iÃY&\"î†¤	pÍ¶’Ã=Ç+d’<q**ñ#%Ä¶„¾åànFåÍYy‡‚Ã…å.Fñy\$ñ†ÀW\0ƒHc\rvÂÈ20·ÃywË„¼8s§®Zò‹P#ĞpçrnõÖ³lş€K\\Å\\î¶2äùOîTsäàÌ,ª·3Á¢‘ˆ²ÁIÇÀÁµéíéKªE\\d·Ì™†ƒÏ„tgQ[\$€Üş5ëå¨\nL‘ ‹o_ W¹¤ş…g7½şxşKŞnÿ.ô½Ã\\jğ˜ôÃ.Úoã\0ëÜÎƒ¾Ô\neXTËå\0È€Ûi‚Kªš\rbğIÌß\$4ìZ\0˜ÀÃ ñLUèx #N¥Š–%D\\‡e¬'bBÙ©è—ªæ%èõâvF‚Ø0~×ä”¤h(ifx¢n2;i óè4dÄ^ÉƒN	©.Œàà·ëîaã¶-	5Èt\$ìDüEbš-Jb2î˜¨ Ê¤,\$Ìö~\"¤î°×\r ØşL3\0\\";
            break;case "ar":$f                     = "ÙC¶P‚Â²†l*„\r”,&\nÙA¶í„ø(J.™„0T2]6QM…ŒO!bù#eØ\\É¥¤\$¸\\\nl+[\nÈdÊk4—O¡è&ÂÕ²‰…ÀQ)Ì…7lIçò„‚E\$…Ê‘¶Ím_7GT\r•eDÙƒ)*VÊ™³'T6U1ÙzHØ]N*PZ,¡BT`Šªìî%VDª5ØAU0‰H S‹d!iQl(p(N¯…Â1÷e4înY7Dƒ	ØÊ 7Ä‘¤ìi6LæS˜€é²:œ†¦¼èh4ïN†æ ­—6IÏEq¥ánÔh/\\äQY2´Òn3Î'’ş½v	•leîÊı†¬ç7©Ftl.nòl?O<B' ‰®Å{øï³Š®W;	ó¢IÁf3ÜlNÑ°·©ÁVƒ³rF¹ B&ı@*”P\\1q+¼lÌÁ^†Ağ\n˜@èé™À²	+eŠ:¢.Ï\n&T ‹ŠF“¡´2‡?IãÆî¯h™\\ÆAÂ¹- ’ôÁ2Å1ã X›²…)1rªœ<3dİ±ğ”†‘•pğ<H	:Í³üÉKã?0N‘Aj¬0ÑÚG£\$¢Å¤r¹K3²šI²*Ú¥C'‰RF\\§êtU®‰dE+(„ãCMŒ\$ù?Å±dû§(’p[ÌğZ§	Ôõ?Ã¨Ø67ÎcrŒcÜêGåÌ8“¡\0¦(‰”1eL0ìêk&Diè‡¶+­CIÔBrIÒ,o8JŒÄ¯@RT†Ç%¹°[²‘CäÌ«4åı€@wíş…®°]ä½Ş•Ìç­ˆmlÌ[òµ©N®ğm\rGÒTù°ø`o¥#FDÅã(Œå{×¹9ƒ`Ô5Cä×ã0Ì6<ã+LwÒ÷É	Ø*\ríÛi!\0ê7c¨Æ1·ƒ˜Íe`Ş3¼ã˜XßZˆÂ3Œ/8AµR¡\0Úó®(P9…)¸†)ŠB0A¦\rc(Ü‚G+µüSÕ‰\r†M©A‚ARsŞ»¿J’…MÀ°í6)¼˜Æğôk\0*ƒC¡*xÀÆÁÃq·ÆAl‰-hĞäÌD1 Pš0n(äÙ÷ƒ˜î7T°Ê<Nv2p¡àÂÕçc0z\r è8Ax^;ûpÂ2mãpÊ9Ş Îïß@ğâêƒHŞ7áš97c§¦/¹¶ÖÂHÚ\rÈmoÁĞğÂŠa½€G7©c~Ûƒ}maĞÙ¾6øƒpt*Xš7gIzÖLˆÍºd8äHK¡@f=.BHÉ)+dğ¯0,bjö6a 8\$cµÁ\re¼¬C\"¸WçŠ—*äÄíIvîä”C@CŒI'+k|…#uãËÙ(…¤Óªˆ]À„p¥]6ÂĞ”!u…4›„’4MH ¥K(Ûô9õ‡êo  fA¼6‚\0‚ø¿8íø6½ \rôƒxíÍØ8cjV@'…0¨BÈŠps\"F´B¶YiD0t¢Bt©aôŸˆ0è‡™^¥ÕÚIë¼ÉD(Ã\"r_SÉ²QéF§+E¿œ¼÷ÁÏA¤3­¥¸1¸5æİç„`¨&ÈnRÁ¥ÿ¼H(dL‹‘²\09çÈ~ŠV*âµØÂœŠO,pT\0 \0U\n …@‹A¨@D¡0\"Ğå¨ObôFAÌQ„e\râ\"JXFT#uIÄÊB+Ø@Êƒ\nÊ‚Ø0†É»ò :‚ØÅ’öX^Ï´#¢DÂj`\\i(5¢8Ì‚Ø2høı²”šb™c.—¢8’ge:¢ª'b¼ÊºõJÎ…N'•ŞÊªÂo­,I+c,ˆÜEW˜l¶¹²ô–šf30Ó0ÌÒÈV^#e,W¥î€“R~‘ÊP) €Lt€áêê<b÷Øx[Pš%\\K–Wr7Šgu>¹BzST1:d*°‡+R¯AT‰‹¥L4‡ Ê‚Œ\rÆß…0ÊnCÅ‹lV1¸¶=J„É¤´¯—ØØ‡Å±5ñjhıÚ»–+Ş@È‘“¤Gw<‡.Ô·NéêE#Ä¼Ñ“™úŠ’ WiÊ©¤Û|YeûGDt­ÅåQ\"~£ Ì\nÅ@Q‰ÿ±¤´­«jè¨U²3\n±Í’‰vÆ™3ÒªôrÑ*-J¤AÀUÑG2…‚Z«]6Ğ^²–/‡éR#	iˆ9Ñ?BÁÉ´D`VÃcm¬:ĞT†‰eÉ‘0.dÍŠsg—	THÔs;Q*‘#:ŒLÀUò&2½¸Ñlä²âB\"É9À&°e|Ï˜².3ÉYÒæäQœEndÎ÷4ÉÙ<‹äp–Ç\$K­-?ØŒ‚G`‘Š¢ö“¤±££¤y£Ê­“#Öb®b„,î¾A%ù¦•D…ë&a–Èİ–[#\n*ñjşgQB'xÂÁ´¤M(Œ\0‡9t&~\"é½ª(’´ÃõÎ(KYa’LÉi”:d£;TXíwDì ¬Új;ki{´‘º‹;{e¯˜¢É÷^ædšStİHÕEå{İWVğ¬b Q	ã°%ì¶_Kºë‘\\ø(ˆnXÍ0U@e(oX«]¾h˜¼ç]Ûx%Û2ûv¦·9xyèC‹Zëš\0QI“\0)T_sV*È¼+hJuÓkºZ8xaË,´äy×–OĞåZ­{Ë:ß^˜I¯ºks]øGÎ+Ûê}/×~Uº:QëlMÊâ'ĞÎòÈĞÿz¶“…„3cÉ…\n¨Yœ¢ò™Lyˆô•pbí?º\nŸÕóí\n¨t9PÕ½úûx¹?âvĞãél€x¢fto¯€×ş\r)eya¼Ë±jñ(&ës›Ìb¡‰K@Wª²3*a,0‰\rÜYŒßµDäÍŒ«úÿbáÌ—´#ø¨Å¸´Êa²/œ³ÓXUOw:N2òğÆÔÑ}ë-&VcÙ˜Ïuá¥XÓ~3Àx+ğ¹·ª;0ùÊüõÙ³=#®*·XÂÑ¿%Õ©×»{Ãí;¢İ@`ˆ¼ÿæëĞ×­\"ÿ¤nÃAVİğİğ\0›\0B÷/ŞİÍf\"ki\0&Mƒ¨O¢&×nº FHKª:ØPd\\rdPtpJãÎlşnÜ0®áÍ²ÿ,(S¢PdĞfÂ£\$Æ†½ĞpA„8@0È£°ƒ4ë«¸éÈqğ	ğSp—¬‚äÍÆ‰£b(LA°mß\"%©Ä9Â¿ëS\r¦d¢	w0T=š(+²GìN!ÆÙØ!Ğş°ÑPûƒ#Åp0\$à£nß)ğËj¤FÒcæº&Éª9\nãæú2ğª0-‹6§°HÊÅ*sKGrÆ|TªH`1J\$ëØ‹íÆNE\$«²]®òE¢—+€€ä\r€V’ÀÒ`ÖŞ› @¦Šl8Æœ ÒÆ¢nÉÄmÀêw @C^m@ª\n€Œ püq¤=61Q8î¬¡#I*ãÎôÓk0¤-0%D†³6G&.rçLŞÇuQ¨Q¬ö\\†a†6@Âh(KO¡n\0Dòb~JêœtŠÆä,à\$Ê‚ú%âtÂd¥G0Ğ Ş{ãÎ= ™%%,\r§ˆ5ã†9j†cƒJd[¤Î¦R_ÎNQP¢Ş2x¨‰g 0(O\rd(ı+tw0ôİ\rõ('r\n…œ7ƒV5£_É(\ràà·Îö»&Ø’£(è˜õBöN£\nºIbUq])ˆ´ß„ˆßÁWå‚¼#ÂX<B ¤ïòøëÆòÂ~hşê#XÎ\"C‘ÜSçvwÀÒ¦«z¥,\nÀÒ î@¬ Æ ê\r«b££ÆËb§\$?\$BŠ:Œïêÿ'Ê™(¬B&¨ÊëäéN}\$¢Z©l‚–rj²€gcˆ5æŸ1Ó!,›2³.ˆÄš*ä‰¥`BçJ@l4AÀ	\0t	 š@¦\n`";
            break;case "bn":$f                     = "àS)\nt]\0_ˆ 	XD)L¨„@Ğ4l5€ÁBQpÌÌ 9‚ \n¸ú\0‡€,¡ÈhªSEÀ0èb™a%‡. ÑH¶\0¬‡.bÓÅ2n‡‡DÒe*’D¦M¨ŠÉ,OJÃ°„v§˜©”Ñ…\$:IK“Êg5U4¡Lœ	Nd!u>Ï&¶ËÔöå„Òa\\­@'Jx¬ÉS¤Ñí4ĞP²D§±©êêzê¦.SÉõE<ùOS«éékbÊOÌafêhb\0§Bïğør¦ª)—öªå²QŒÁWğ²ëE‹{K§ÔPP~Í9\\§ël*‹_W	ãŞ7ôâÉ¼ê 4NÆQ¸Ş 8'cI°Êg2œÄO9Ôàd0<‡CA§ä:#Üº¸%3–©5Š!n€nJµmk”Åü©,qŸÁî«@á­‹œ(n+Lİ9ˆx£¡ÎkŠIB›Ä4Ã< ŒÀ šâ5mÊnÂ6\0êÀîjÀ€9èzĞ ª,X‘¶í2À§§Î,(_)ìã7*­Àí\$ˆSEÒäŠë#´5@ĞôRStÎÛLî¼§ Q2°’Ë­ó³´òb‰4§qCİFíÚ ¢Oq]¯,ÒªzÜDĞÓb÷±.-&–­Š‰&¶Ôó\nP©å\nÙT¯âÜN)ñ9.´ÉÎÎRª¥<ñ#¥å5n¼×4]y3•õ\rKNÂ.Ú6PÁ§ØexãSå3IËÁ9Lî\"ñ)Eô/!Úh#8QÉTÔ-É@8è½h7Ä_N{(ØÈ‡7.ÕÔ„¸›\\U*‹A—*z•eªkeT.Ëd‰ßrˆIíºğOÇô%ƒ¸°j3,2i¯kô—¨•ãŠ®ô¥:¼+·L<Ñ*€â—±DÍE5×Ÿ°ªH€2\$E	3“;¢¢OSDU@Ã¨Ø6>pÜcİŠ\"`ZÙIwå¶HdìÂ·1tWi™5»`ˆ_l0ª½•¶q>’ådĞ’\neE5\\âÖå²¸]ê%Å¨;;£Ge5ã¬ÈJ\$úêZ7G5äñ#SêPÅÔtÉ•^¶VRb×3¦¼åèS5;ÒzŒJÕ›o¢×C0°ÙšRŸ\rï4xÙù\$úŸ¥·7j{u»Î˜U½›‹Ú­ø’1äà±.06ƒî»ãäò\rã0Ì6Fƒ,SVÈXSSP¨Ï8mlÁäPÜÃ¨cgÄ9†f¼`oèĞ9‚Ãæ  aá…:ÂA\0mFÔı€æ\n_¹[_.°«\0†ÂF6¦ÌÖ–â SK3S0¢¸•°²lÉN*ÖEã€à?‚\0°ßÛıiï9x<ôF™İ ¦hM,£)øŠ`Ësg†Ü¾•òÜİ‘	\"kd[”æŠÖÌUğYıCè»–¸Š\$Õ!¥nS‚hagè9ˆôÃ¸oL2‡€à_xdÀ€ÀûÃ0=A :@àx/òlÉƒpe@ºAp^Ct§ê†ß*AaGÀ:I ¾€›0k@ø\$†Ğà{ƒl¨€ğ†|\\O”Á?½ŸHBCYä\r!ĞôJ((Cpt~ñ`‰-v<†+6Š%EÅ †öŠÙK‡«äSF4¾l¢)ÒZï2r´ãnR¢Ò×\\¤«³3¨@PNS€€3eYHô(“ÙlÏƒ\0\n)ˆáS¯ÉÔœÉ2¾T,\"™ä¢»¢qxTÊ¡¸E]aQ]J&€°¢*TRVUi¾ WÈ[+(2¨wU\n“í:kí³mãTD¡š”4¢­Úb3AŠšÉßMs˜Lôæ¢Çj”‚I'x@ÒÀÏ4Ôr¢fŸÓäûÃˆu>3P3 ŞA\0A“ïÖ>ŸÉP­gÎ·GãàıÓ2Q(	ÁÇ‹À@xS\n„9Ç²2«“uN!æ¡EïH\rEfS3fUÖ‰J,ê9a©SnÇ\"‹‡Uj,Õ†şd\\	\rt¯qöXÍeøo“À‚G ÒÁ\0Sm €3ÓÈ{\$pF\n”	³00Ó/¤Ôšw2»WŠÖ£c(b3&ä´R±a†³ubÒ™ÖqrÙzD÷Y•ÚF/›¨pÑyP(1L¨Ş{oMŠŠüRU³çİÿzj	Şö£lÅ3UY>K`‚ eÁ…¯M@ìCerd1=¹\$¾™aI¬`€?Ô€”Ôz»-˜\$®âRlø…;GÄ^£cÃŒògO¢Ã\n/£kªİ^ô‚Ê®§hmÎ|EÉ­+'¹7*)ØJ5C•²á£3ZN• Åe'¼¬r‚ÊÂ—­xè÷­NZùMÈÂµfõÈÙHÖˆÔT<b[…ÆxOÊ(š´•‰É«Ëˆ«£\n'}šh‹uU S¨\\ÔÈ‚ÅÊÇĞi=ru\r½Œâşßò¬¡Èu.¤…ìŸ-F2;’)aªÇ|)ŒÑªµí^#3;×;N†¡-ÏU`è¦@ÃHz (!×pá	6XS§¸1Ÿ ÈÈW¾]J™8\nd²£„N[;ükË÷‚•ÒÇ˜ëchÄíº’6WË9]/'3‹H0JÕ¶!6­½ŠãŞúá©ŞVØëìâJÅY¹©³í!­íj9ÜZéEqjó’IÎá‹IÓ³bñ1ÉDê9‰RŸrvJ7çrcZ1¾ÚŸ+#+vÅ%4ïõwŞ[ºÌÙc®êMR¹â:ìøÛ	‹nÒ6»¤\\{Gà¦u\$ÆB\0^ÕÉı„0§Ö× é¯¥µ>p¸˜_O2½7×µŒæd­\rL.Ãa›qnê‚ö>•Ëú7\0¤=ª(öÈÒQûZo]ÏŠwYÙKõyË™”ØÄÇ,ˆxÙ«èj&¥Ï%ñl¨\"Ø¶·øí¶†Õß¸~béŸ‚G¬—õåİ¯U÷¢×nKimlÿ¤ú•ë¹ÜR:¥úüa¢½‘Dğ¾×ÉêÏåÎ2øÍé\\&]{·]ƒ¹!J‡·Röq/I2¼lü^òôXI™ÇQËìÂÎV²ß-İê_7Ò ^˜¥ÛXåº”ú*zìÂâîWT.OÇ\0ÂYâğÜä`éÍt^åR;û¬`ÿh¼E¢Ùí€^ã&¥bØ^ÃTè\"æCtÕ#n[j(æåQÄÄ¤Ft×yÂj¤í/¢\\°fÜ…öU#r_Îœ,´ÎD¤Ç£5ÏäğÏlŠÏ+ŠH€up„¨œ¾\"Ü‰lß	/™¯êñç	ğ~tPˆæ¡rIRS¨ædÇ<ŠP¶ïmÄØgm²ÆX0×	Oè«í„îÏÊùï0Doå0ï\r¯)\rğø¤°ìÉÓo%ôÊÆx¸£b\rfI¥Å‡#ˆR†fìúÒ¬¨QKaC­âğ2m\"4s¢#/Å!zÀñ(İ\rLfï‚Ñ¬bŞšòÍøPüŞÑ\rqï©­Ò(lr÷g5g¢Ø‡€P«Lôj…'ÄTGºÒLĞrpäJ-´à¹Q\rÎzå1¾xQlÎ%î¶1¦ş\$,ş10™®}gléÑ®uñò1í¬èÊ¬ïn±Û LÎÖQöuqúÜÂ®S\$.¤ÿ\r‘ÎñâëĞ&ñNå±€b\n\$TèÉå©pñÂšï¤1Ò,½ ñ2+\$®E’JÀ/%!#RâÎHngç^Ëp¸ËĞ‘²(\náC ÏuR3%qĞõ²*G_/vU+”Æ'¡jh7!†qDª¯\"ñâÇª-«(ÌòÔüTÿBØ&¥ìÖpØÎÈÙoî¨ëå-Ì	\$o#/’ã#ñ–Í²¦Ç™-+oZéˆl¡be.käÿ-ğ‰Ğ¢ Ä×<Z0ÖcrÄæ!ˆ‹(©î¼Î±L!-…Ô†q\"¦1Bt tmÍpÌkFfÅm(Ücç0Õ!Oç~QE¾+ñÅ„«,1	9\r¼[Î‰²g(R£³©‘·d®W=2¤ï/é)í8Ğ—¢İ<1jÑó‚ğps*Ó‹&“=Nq<Sİ;’¿*ó£>Ó¦ç3ó\rë ğu;Æ}=iïÓô{T)èÆJ(êFç;\$ÌlìúhpDfùBBØ´TG¨Ï3Hœë8GDÎBÒãc\"¥¯)QÇ¨á)Óëò)rc@S„;3¯,S¥F°&Zò½A’ÁÒ‡5&4ÔsŞú‡ÎBî(*%qåTî/óáIpg\0¦ñ´ÏtB†MJíD/H4½,¾œÓ\\ô(¢Î¢ÜN&âEEÓ´e=1õ&²âÔHí¯GQé=òˆ´ô#ù:³»HtïPo+P®+DT­IUMÏËYDTÍ1¯¦gÍ¿4@ÕƒNp‰EóŸH“²ò¥6gmKR0ÿ@µPRYUS6èMKS1ı>s±FhŠhNÊyÍm%ôXXª¡5~ökòk#<½N³&ôÀA	¸*urzå°¿<u>”ñ%¨AYÒ}L'‡ZsŠUªæu¯@3ù#s¤œ¯ÂX¢¢¦íLfeRr;-T-‚”ı“cAµ»FÆúQPz_°Ä dÏ%5dM˜} Øk\r Æ\r`@•ëˆ>Ä#ö€)˜\r Ì€‰¦. Œ¹ÈB¨ö\0Äš@Ü\0ª\n€Œ p	Pv6F¢ë_³ëï'b¿\$‚RRM,µ±V5µQq[Îã'6u^6xx¶~Â±WTy°\0¦,Ôô,ØbéÓ/kHœ¤(R`›cv;C…ÂÂM*“âçó\$ñPZì^QGBÈQj/‚ÅmQlÔ°X%\"ˆ§hVÒ\$ÃDU7ã0oõôÈ„pìÖ›¨È@˜¸JÌF·qÈBCÈ?lDA'“oZÜï‰Ğ½¤¤8°L;Tw?·@Ülf¬VàâóøÌHÑ[u6÷TBã‰—bäiu1%\\pË9“ÊÛr›a1\n\n†Ä>#À<CÉdêş\ràà¬ÙItçri}jŠNÓ93w²¾ìze‚\0eĞf-Á<(‘0Ø17ÍJÁïBÂLNGd[)ê¦ˆß~“~C˜OŠnµâJ)Êò¶4èò€ÒÄ\r’¦\nÀÒ î@¬ Æ ê\r¬Š‰Ô/Èe÷C4Íz-Ç6­â³§wÔó‚(×IMqZ©“Ú9’ç}ÌìPÌ{3·Z‹w^õ6ã¸s†%‡”šZ7rÙ‡Ş?#È€XW©bØ‚'+vSYõï[äDT2´8£w€	\0@š	 t\n`¦";
            break;case "ca":$f                     = "E9j˜€æe3NCğP”\\33AD“iÀŞs9šLFÃ(€Âd5MÇC	È@e6Æ“¡àÊr‰†´Òdš`gƒI¶hp—›L§9¡’Q*–K¤Ì5LŒ œÈS,¦W-—ˆ\rÆù<òe4&\"ÀPÀb2£a¸àr\n1e€£yÈÒg4›Œ&ÀQ:¸h4ˆ\rC„à ’M†¡’Xa‰› ç+âûÀàÄ\\>RñÊLK&ó®ÂvÖÄ±ØÓ3ĞñÃ©Âpt0Y\$lË1\"Pò ƒ„ådøé\$ŒSÓŞLà®\$ÓyÉò¨ü†ğËÎ)ínÔ+OoŸŠ§M|°õ¿LYCŸPÃ\$ã`®¹¾¡¦C`Ò¯¾¢ò’ P2½(è»2œÜ=\"š^×‹«.6„ N:c¬czF9(8Ü<²R©éÂŒú‰#pÒ1)£ƒ(hÉ†Y¹ñèÓµjÂ7;ã¤‚qÄL¢¿Ï¨š‹ÁñĞN¡Áã¨Æ:!L„¦Ç%l(AµÈ¼7Ì¼tš1,[.Ò¥*„ç£ @1-À:ÎóÌI’rôÉúˆ#;<0ÇüH—° Rh8ÄCb;\réHØ6\rã'J5ŒnıE%	†Z›U2ñ.NÊ2RÜPƒ&ÈrM±|ƒ0£u?P²\0¦(‰ŒˆÆÊNc¢<:BöSÃ{æ2QœÏ4ÌQØÅÃ±„¢KãLÃ+(t¤äş2‰¢D“wSÒ€^J*;o\\Æ(5­z¢hªê’B(ğ‹X ‡v„	Ø0±L…¾ƒÜ0íÆÏBo 6AàSFÒ¤¨èŞ3Ğà(cM\$Kl€¨7«‰ôW†²RÕJŒÌTÆ7¯XÄCÊ<3Œ+ËŒ7*²l7Z(P9…)^5»á\0†)ŠB6; pÈxä½#É8Ü×\$©:¬º¸Ší”yPİ\$'’&T92™jb™ÇˆÅrÓ+£€Ó™ı£±¦´m\$¡l‘š1—\$RÜ\$Ã„R9ë¬ì2àüË¯„âh42ƒ0z\r è8Ax^;ör?¥¥árê3…îÿsZ»èÌL„UèäØ8¾ÈãXD\"ƒ‚9f‡xÂ**„İM\ršj0ê5œ Y”’˜¿©MÕx=ˆKğ'EB\n6Cêr:ƒïÑ0çò0ÊëpÉW,»fL#ù)äp‚¹ÇöïŒ \n (`ŞÂºQ\0 ¨‚”:€È²67ÏÊ*'¥šÛ]&ïÜç‚s4åÔÉ,mEhô-rjNÉë0¤Uû‚j²Ó’I&…D˜„’\"M\$NÅmg\"¤ìn 2‹¨€’ äz\0AĞ“¦ªÔã‰Ëöl‘‘²\n<)…BÚA>#ÑE\$xjœøu9P‹#0@WÌ8Y©®·“Ø—±›DÄ¬„¢…,Ş©¢ˆ+†¼àŞGÛ(b.ëd‚8@ ÁR¤tìOXBÎ…Aš'¡Ã&j	‚\$1h€•´}YQ,õF?Ğ\0U\n …@Š§åÀD¡0\"Ëä6ÅQÛ*\rÔ6¨3â¸IK–D\rë™@HpD’´Bp§Ã‚‡:”319&ÜrDˆ4‘¢0‚ˆAÚ%'pïä¦È³\\‘š-óÊxMa=2 )1Eõ‹Ë\\\ryÈ…8L‘È1â'°ª:18À¸‘™1P•\\\$ôî¾hÂ\0aa•w6B· (ı¤'Ô& \$ÌÅMbG¤\\d¯ #LÉ(+ô}\"\nˆ:z¤xù&4®ïâD)ğ.•ÖÜèá\$YÒÆ¡Tèá)Iü=uÈy¯9“øiKa‘Vš’ê‹Ÿ9ôHò`¬„Ùtæ«S.f™†#CqF	I4.dÔÚˆ*ª¯.pú„dL’!³ín	ß<K3r®V¢…­ãù.ª\"x\"»Ôe™C!É‚†å6F§H¯…#¤“ÀÉ¹°Ö±%% ^P\0E5Œú„EÇHé+\rD(Œ\"·‚êÙ“„~Æ)‚'À^jvc€2§»¤¿î¡õD¬ÕG9G¹Mâ¨†šÏÓåÓAät6×ÕÎp	»h†î•ÛÀI	Ä‚¼Œ¶ó´˜•v/[Ö½É¨:BCúaåŒ'åfï†;Ã*Sãr¾‡ãŞòİãõæ|wZA]ÃqIv¿Ë^UšU1\rá&TMgDğî¢	\"?¼«”¢d	Ã&1\rÒŠãZ|úá(‰l4ÈpUAÛBäİ\rb’VJŒĞGÉ\\pîCÅ8P«dûHRâ(¹=k6•ŞKâ}¤Jf€š²tSl'¸ÁÈú„„&0Å’­t¶°S˜Ahh+‹E%Pã4ˆMb¬¨ÉÇÂXN–Ô©î>ú-ç¾=âŒRÒä‘ÃÍ/DsåaìFPòk€Ì*ÎGi¶†êhq¤õ]r&3>ê4İ{\\=5/vnÕ®à–ÖÀF6SIj—ì;öA@’ì]•­¹?Ù¨İşÓe94¼iÕL”X[`ëÛR›2±X*õ:ë£d\np7*ğêJÓú ñê*RŒ)^¥3K´,â›¦Dı¤Ô¡ï£»uW¥\\hbs¶øN÷b±‡0ÆÄ¨=\".Ó‡¾7¬	 r¶åêô]s?zõ=¾\0'¬»cÄyìä—úõNS_µO\rÔÛÓ\\›&Ä,ªGÕ¦jöò®}:\0f•İƒÒN#Ò\r/J²ÎD&bE33%|w.ÆÅ¤gb3H)æO)ãqdOdÚlşdõzë»šCÉa´—šõxÌtâ—şxLvc±ƒìU	¸7Ée:—B«ìG‰¥…T‰9®V>Ï‹%2ºÂÔİœr	1\\86 Ş¼E2’OC«ı' DœY²z_5¡ëeJöîøiÿ9{ô_´ôü#ÜéeÊ¹ıéÎ¸Ğ“ûIÖœíM0«ÈMûæ…ÛLW«dp’ZN;Ï4R;æ(Ğû|	Ï¾Ùz÷};ğr7#ïëú;g=ıG~„ÄQéŠ¥1Ë7ÕÒK%úê÷Ã]ÿÅÏĞ#œ›Ô¿ç/M\nçobÕ@N´,Š³IRã¯¼Õ*LŒ.¯ÆÖÈ&•/ÜJĞ%ê¸0:´i®N@à>«tµÏ¯\0êŒDDmïlâV¸p\\å¯x~XAb	R\r\nÔ¶Îd2\0²Ëj¥0j>>äºYÄøş\"˜~îX¡æ‘	¿Ïø#.ğäº,Æ\râH/ŒÀK°^èÄøÑŒ6áÍµG6Ò«x&-„ ¥Şd\r€V‹nl¥Ş\r®×°q¥9\r…ü&¤@YÀÄ#¦Œ\n ¨ÀZÌeCİ¯B”ÒkÒÀC	ï8Æa1\$äÆ2à¦\"ÆüWâP-Œ/BLÖ&\"±…Ì œOú`ƒÖ= è=í´Ãµ\$:JãÇ‡ÀæåÎ\$ÀÂ‰…(ÙcTbJ2„P&I£¦	‘ÔåŠ6ã Ğˆ\n„è¹ƒî>°Ì^8ù-T6DÛÑ¾FgœµNÖÈ¬uæTpQØ7‘ÜàÆû\n)£À¨§d0cPNàÊj¨=‚l¬f¾§Eêñhè0/J¤E Jìj¨éªø×1¤İ¢XİéŒÇ#-ÜV%îíÌsŠtrÃS`Ò!M‚_Ä¤>â^G\$!\0@­àÊítÁÉ˜œÒO&/D£ §¢ì\\ñZ©¤21Öœ`ç/“ÆÈ/dªã\nW)Ò¡) †Ïåãp{g)&JÄsï?&à	ö.Ï&ø‹ÚY¤:Iä”	\0@š	 t\n`¦";
            break;case "cs":$f                     = "O8Œ'c!Ô~\n‹†faÌN2œ\ræC2i6á¦Q¸Âh90Ô'Hi¼êb7œ…À¢i„ği6È†æ´A;Í†Y¢„@v2›\r&³yÎHs“JGQª8%9¥e:L¦:e2ËèÇZt¬@\nFC1 Ôl7APèÉ4TÚØªùÍ¾j\nb¯dWeH€èa1M†³Ì¬«šN€¢´eŠ¾Å^/Jà‚-{ÂJâpßlPÌDÜÒle2bçcèu:F¯ø×\rÈbÊ»ŒP€Ã77šàLDn¯[?j1F¤U5›/r(ß?y\$ßºâ¡±Š¡»”Í¦Ö´JòMxÃÉŠ‹b#&§3a„DÖM»áÂ‡¤ÀÊ:4ƒĞÆ2B˜Ê=#ÃhòCJz94ÀP2ãl9\r0@¦<¨ÆR6Á#(ä N{4µƒ¢‚	+è7¾ík\0¶Á‚,4‘B9·£œ*Dã¤¾Üz‘;éâî+#€æã¢‹ø-\rïsÉ ŠXÖ×©`P 7CkH77¨”zÔLS\$ÌÒ·­›5¨{Vê\"MÀÖû£ @1#PèÏ³ı:4\$ı@PK›Ù)<Â0ê7\rp8 ŒãÊ3¹D¡5Ê PÖ2ª\"„;D¨°ÂÔ±r¶84dØ&&ˆ‰0mü\\<”pƒJÇ#’æ1˜AÈëó9Áâ˜¢&&ì¹[=T»`	#pÇMCCs7ÅÃµ¤Å°C|VÅÌs,ÎŞÊ±¹B=9×Lß4(ö\$Dñ½ƒ¢sŞ£Eîû\nw´Fßİ£p 	CXÂ¢HÚ‰LXŠ<b\\¡}\\È»]e¶ VƒÒŒ¦Å’ëÎ£3Ã0Ì¡\rÃ*V'Œ’\\~ÈÇDÊj¡;á\0Ú7\rö+:k˜@I(¾e&´Á`@=hrüAZ˜ò„(Û	6\r°šæãNsçº#‚:è%~‡hèÑöšéZfÉ§6:^x;jmş­¬Qv·ig	öÁŸ\"Z…¢I[QC'»nšn:é¥îÓö®76Ò\"ú‰¡{§ià@!ŠbŒ€Êï§zpÌ”¬˜LîZ–_˜ğÜBn9K-\$zÎ.ÊNŠœe \rãr(Ø\\;ë¥h±ãêïéÒn¢¦¯ßÛL\\Æx£êÓgÃDdúøèšúôã~£0z\r è8Ax^;ÿuWÉÄÁrRÁxc`¼¬¢àÜñp/K(9tûÂøb>ªPæ	Úİ5ê2ƒÀ^Aó:@dL¦”`É7s`\"BNŞsMy—tÙ	ªbô’‚t“…I+/%î;€ôwÉ©q=ÛBŠkÕ‚\"2Âú\"E ôp#8Îib\0 € ˆÑ VÄ£LAP.ZØló^ñß8ÁŒ1tE\nê!±´*Wpqñã%æp™Ã˜|NÜÑÀôWH™Ğ#„ê\nÓöT	ZcN‰ø52‚üO‰1ê¬ªR®D¢F\r-,ÈÿJ/á¬¿-r—I”n«ˆL 6\\˜›ã^'Å\0Á@ Â˜T;ˆÚG­ÔšÓ—iW%\r.H™×ºDÙá¯7`ÒÃ©Ã±œÔ©¤¾‹!L˜1…5Ã°@³–H\$åX6—3/ˆéaR06†øèM‚0TŒ&ü˜1SŒIğz#‰	¢g°ÃHz‡'DšÈÖJMY=Òä»³YVº)¤˜\\†:\$(P¨NGõ‡Pà¥©Rï®ô8†’êu\n‰Dû«„öc	ĞbAáZ¬DÉV)o\\Ø%¡™@ëéiJ³,ï[HÑ’“\$Ä,TÂÍjË<6p(çL–ŒYf€ÑF?L‰Yø6há?Ç¸RDÊ1a†öV‰—\\×yÎbëíÓVI«úî^•÷%;eLNâ¢\$_Õ@VDÔ)ª‡0ugcès‹Ñ‚1&HÉ¡ÉPª-Ã¼`ÔJ%ŸµA<176iF+i¡£•\\*1Ã	:ÊD(È\$‰Bj_ÌXO±²\0¸0€É^C\nôMª€[ÓiOÂ™¥Á”1€¥²©Â^K¬’!+ÀƒÂĞdw¨6n•×›4GuLæÑ\"mEiÄº¨p3Ààåx¯™ÇK³~ÿ_³XtœÙZ†2ªğa\"]á[ş2“X<2(s«‘ö°ldŞ‡TV‹J\na öšÈ_ÃÒuP ¼¯¨W~©ZŠ2ÌÙà(œm kQÍqiG¦Ô|¦ŒdÌV•P£å aU?R{[ÖDZ™\$œ‰E¦O®Í-y¦yÓ•Kj\r0­í›dX¯%2@›G¹{&<]HÎdLéœ(\\¬ƒKœB2fU¢“U©\ne£!›–ì•¨]›²ærÉNû05­´´>‘G°§%ãwƒ´zÔhYÃ\$»Í)“dË¸£b¦á«F®I1º¥!óêİ’Yæ˜Bv´·T¢Ï\"”Ğ™lgäğ7’°µBÑ2(N¥S[Ú<¸e%¬ıĞÍ•qzA*¨¤-û0šQÚÇÅ™Å+¥’¼\$`u³‹ö ğJ1)C§°âo\0èdL9Æõq8tÚşP7áÎ“KÃ&IÒæÉï<û`kåPzNô£ƒïşÊ‡\r'æàq[¬œø{7õá.İÏÇ­÷!|™K“’¾>®xÓ!c›ŠÓïS‘ƒAñØŞ=\nEQíF¾Ó^¥(€“ d4…\nFBws°è­\rˆ?›S6†:ˆlN¡\"l.wÊÌ)Ê§–ZùNÃ€ ¼Ågeİ áw#F*äúVlœà]^è0Î+ˆX52ãM2†¥»ÄÈõqFŞ½r'Ìåï‰ï(w¾Ëä±ü±>0çmÒræ,œş5‡•óËçø6bÊ9”ÒåF—šlvYÂŒq¯O#x§ªì°7f^»óW²ôX[Ò¹QîsÃP÷™÷4| om¢gJüˆÜñß9+%tC¡ßƒ‰õü¿ÛúWßê}ü¡ãì!<Ø×¨7†¤î_Müÿ#:¬†öä\rÃœ9&\"´£¢àÔ‘\$ªNç6Q\0àiB<OÏå\0F®ş¢L¥éVu¯ò&Æ‡ƒ¸}¤\$ñÔ\rËÀ?Œ<ˆ¶­Älÿr+-ì ïÄû¯Ê«Úfî&YK®>À´¾%ĞÀ\"íË¸ºbvQhöÏJB4®T®äŠôLğ/®æOÒ\rÂVó+\nMPrÃŒ<{÷NL4®*\n¬:…èöÏy\nğ²#0¤ñĞc.:á¤Ä°¾‰åò°Ñ\n#Û«Œ3£Ö©¦Z» –\"¡|Ã®‚\rÚ¬‰¸¹ˆr<ªŒE¯BÂ¯HãP¨ïÍRøqòĞ»qö®÷nhØĞd2Rƒš¾Èzq\"N°˜7±2R«/ M/fÂÄê¦ ì=ğ/ÊxHŒDĞ‚¹ï³‹÷`äüxåËø¿ĞĞ“Ñ:ÀkúDĞÖÄƒ]ñ>#ÿ\n´¸`ªÄãZ(1jï±qc ÅøüïÂEQ·±»q(ò-Œ#â*0>. ¡/HM¯>2-º¥Ş<À…`ëásÍö`æoQîê`A'Š¹|²dÍr#R4qög]!Ê%`–#&æ<Å\nY:Dƒ¡ ¡22hc´EŒ¦ÏÏ`Ë\0 *ï\$cDÌÏ\\Ïë!Hö#CVTæù~Êï dº\r€V:\"†V&œÙäò¢¡(†”KäLŠEˆ@æàè*m·P\$‡bHw©Úhœ£mx&Àª\n€Œ p%rB ¢R62¸xÒLùÒQ%NÔaòÎñ}& g-ê\r-2q. \"\$\"„vÏ'¤d% ck®N°b¼ƒBşÅ€¥Íô2 –#Ê/ÄDn*’›(R\"LL28êì·2*+.aE(>ÉQ*R×R¸:­r\$\$ªˆÈ± Y	Ü£az>ƒPÖN^0ŒğÓ‡-¢ŞÌÎ\\·ÎÄÌoe&6Ï8Ó~ibˆjÕIs9«¯8ò3ˆº³œìf†\rî<b„âRÒ¯†_Æ;“®?œ5\n†%@JBç|\$EˆA†Nz\$n~(\"‡eB³KƒnÖ\nÂt†ÏöŞ\"ğ0QÂZEÄ8â0>ssÚé#âŒ2\"<4)€‚#Î§<ƒÌI¸K®†4eaBÜºJÁ9JÄ\$ˆœ)¤\$ŠJŞ¡J±FJ¶Jó£:j/4<t\$\r4>º)İBç²—#™i?Â¼dà5Ä¢";
            break;case "da":$f                     = "E9‡QÌÒk5™NCğP”\\33AAD³©¸ÜeAá\"©ÀØo0™#cI°\\\n&˜MpciÔÚ :IM’¤Js:0×#‘”ØsŒB„S™\nNF’™MÂ,¬Ó8…P£FY8€0Œ†cA¨Øn8‚†óh(Şr4™Í&ã	°I7éS	Š|l…IÊFS%¦o7l51Ór¥œ°‹È(‰6˜n7ˆôé13š/”)‰°@a:0˜ì\n•º]—ƒtœe²ëåæó8€Íg:`ğ¢	íöåh¸‚¶FÛşÈA´ŒàwZv \n)Ş0Å3Ëh\n!¦pQ:]Ä9c´ş>Öbdè'·((™OšøHV¼'‡_d2ú=ÍBÊ)¡C²şì»hRØ;\rÈ˜Ş‘,ï@ˆĞ.£\n€÷9[Ğ(!LŠ.74(úÕŠÌ ØÚŒ€+)è+Ô:c êğ˜d3HŒÃHÊ;QŒfÔ§ÎèòĞ¶º2~2!,‰#&£œO;‚2+#z.ğŠcÚâ\rÃ3@7-nà¦;ƒ@ì³k#4ŸºmÂÿ/\r‰ö½ãhÒÃ\nŠjp64c:D	È6L T¥8Çƒ`Z9Œl“ (‰hÖ²CC Ş#ªÆ.{.0Æ\n»A-”s,J:B0œuT£šÈB{ªü µ˜ÂñUƒ\$2ÖM…v(-ªğµ/âHÚ8MÏŠ•Ùƒ“\r[2ÔHUÕ¯lQ'\rP,è ÂÒã0ÍB\"é8˜ä¯@¨7¼Ğò\rÃ˜ê1Œv\0æ3¬ô<µab`9^cÎ0­nJ‡\"NÃu42…˜R“Š£8ó8­-†)ŠB0Z±¡*XZ5ó”¥H¸å.]N@ÂˆÀMXòÆ‰<\09 Ò²æ¡]³áp»49ÖÚÀCu3§Lˆ¿5©D\$øÒPXË×åhp@!\0ĞŒÁèD42ã€t…ã¾Ô\$8jò³Œáz•¹	­ë*ÁxDºKé±ãf7\ra}e#Í‚”ø‡xÂ)Š[ˆ±¤M²Î¡|²Ğ:uUW„2Éqyµõ¼ ¨í¢ĞÖKh@;>µŒøR×êN¸1àÉ¤IûÛÜ.y{Mz\$C’p2ìØ@(	€[v÷‰ò€€…\n R¦ ,ï<S=š:¨b¸»|ŒCÚS?¹3~“¥*rZ—²Uc<3'Ã¤Ô\rğŒ5·µÆF™yJhí\$¢;r\"W	\r)7÷XÊ	€hE\$ô8‡U€hC1Ö%á26ç²fŠXc#å¢àÁûís!@'…0¨@ƒØ8ïéY?ÖjÙ_\$6§ÔägÈŠØ)†¬¡@NÉë¾)a¥Ì5ºZQy o(“˜ğ@Ì‘#ÄÊ—2påÂš¤Ï#Vº‚ P<¤ee¬Ò1àË]zoê*(e>q!ÍœÊ\0¤Ò´ˆR…	á8P TªÖB@Š,ŠAD|‹ Â‚\0PP\\ihü i.‚B ytGº-¢Úw eKËôĞ‡bÛR[qkŒ¿„Ãy‰( 9¢˜ç„`Øß:†—ç0¾(`ÔŸc‘+âfj¿5	ÁTë‘5f©<S\"8`¯UúµVç1y­‰œ{V o_!ÍBğ¬¸ÃIu¡MV\"äœQ Æo\0éÌ:ùâòŞkÏwp-é‚ˆ…;~|É¤6ÏÊÉP²|—€)<’³r³T(T.¥Ü¿…0ÒhC,Á‡¢yNa‚!Ö#Š4j¤šVHEÀ‘²ş«Í*OEü%’TşF¥-Ôàö…BJ‰Ğj6ÑÜ¾G¨ùQKE	*4R£Ô–ZMü™thm–°Ö‹Úö[¦Cs\"a‚’š-eü\$7zôÕâ»ZŠà1ª²ƒ(j3Ñ1•,\0àçË“¾H`€•d”oY	I)Å\ncxBYmH‹¶¤³BÂ[°ö4Æ\nş)Q¨r!,ÔÙeı—³,.ÄXâ@lı¡´nÜöµ&–Ôo(NrÔ·¿aâÅ§–Ui0¬\\W²NêâZ¢NÜùî\r)ØĞ`î“ŠA#¤|¨isvâä2•\\G£’/á\\2†(æB£¹ ÷@›bJzCxp€,¦¼–å·È©¶¿ª\0ørE	Ñe‡%ùÍÄ@CiHv™´Iğ††WåU•·†C,ø(AÍÎ!bOKèáKÄsdüâz71Q­Æ[£Y†ç¢˜½û€ Û‹9éPKİŸRú_äÒÒNî¡!uÆLI‹:<9'(7€çQ¦YğÓJv¦2{ŠÂmåê-(hK\ròPÔŠ\$\\I);²~¸Î|b‘KÄ× ¸²m ùÀP\nXh\\fÚòNC™'æ†gdü™luŸ–ÎwÆx¶q-YÍ8m1è­\$Å\rÃ+z´¬ÕŒ±\$bØ†›E‹@N›­yßO‡MCkl}¨6ËJj™S&7Åx[Zëz®³3›zØØG¢ß>Ò”õ8†VFr!íBRy³Ü½%ÕŠZ8“|Ğf†ñUË®vh Ä´æJõ¥EEm:dR˜ÈˆT0ŞJ¢¢O\\ÉÜ&y=£yö-M×'¶ T%zj%T\r–V¥né+K»UØ9“¢#„óŞ¼›|X;ñ-“Æ‰8N˜Õ¨\nİAs¾y3n¶æ>Q´Ÿ,äñ+l©·Q÷3BuÌĞ†t{g¦O:±M(ô‰Ëá¶_·\rÏĞT‹5—`­Zw]ò²õÔöG1êúsdhŞ@©ÑÚüp™Eóƒ«:‹â/=¼ó¥v6ñ¥]	Ö_\$Öò‹Ã¦h¢•DßìU‚§|*:K1ãN÷V<5ëüàıU#ÃÛ<mY¨Ç£–§;;éKïúSÌx´v+·‰ëİY@!#5Z:ÁÂ\r!ÚÏ,R’²1dÀ’«âå`û<ëˆ±Ma{“îWÕ»ŞóÒ¹)`ËòS¢ku&³ÔÖÎäıaôµ<Ûg¨6°Ö¡^ér.¿#WÇ.ç4™¦i·f/mmÇNd(TÀá†PÎáZa\$öoQÃ+¦ul<¹øµÂ„*HÚ²(–³­ÆDb0àì`ì`îÂfì‚ş7¬ô¶Ş§Æ@Z]ÂeC>4/ÒNI*üŒ´/¦l ˆüc¦Š\$®`9ÍÖ*-¸DÖ#\rğ•ƒ@?,vÆÄ(\"š¬ôeå&	¶ÅˆÌ„Ï	¬¼©†ğ^2ŒÃ	ÌôR`àFÅ¤Æª9	‹ÄÏ¹	p«…p¿\"b2)Û\0# WP¨Öä‹®:\0ˆH™ú	¬€<- ÍäüwíÎ¼g¹¨ì‰…°¬B/âR>)âPŠ@H8=\"tÅì;…mâÚ)âş\"Ø—êà\n‰«âö„âz< ‚Ğ0É|˜\rôPBæÒä'#ÍP²/à†'°zİpz-/©üä¯&b<QÀ ¨':õcP<ğ\$4®òt@";
            break;case "de":$f                     = "S4›Œ‚”@s4˜ÍSü%ÌĞpQ ß\n6L†Sp€ìo‘'C)¤@f2š\r†s)Î0a–…À¢i„ği6˜M‚ddêb’\$RCIœäÃ[0ÓğcIÌè œÈS:–y7§a”ót\$Ğt™ˆCˆÈf4†ãÈ(Øe†‰ç*,t\n%ÉMĞb¡„Äe6[æ@¢”Âr¿šd†àQfa¯&7‹Ôªn9°Ô‡CÑ–g/ÑÁ¯* )aRA`€êm+G;æ=DYĞë:¦ÖQÌùÂK\n†c\n|j÷']ä²C‚ÿ‡ÄâÁ\\¾</‡ÛærQÓ¯@İš…S´—¬†J97%?,äaäa#‡\\ç”ÎC\nT÷¨m{‹Nœ\0î£0èí	Šk´! ,Ğäã(Ş6Œ£¢è2L¸Ä0ÃZ<½Ck¶†Ë‹\n7?Œì.(#˜æ;ãé¤häGB`Ş3  TiGÒğ»Ìc.İ±»5¹PğêŞ®¬HÎ¨¯x¬­á49 Rú¿¶óI2<`Pœ2¨b…³	ô‡ bò’!,ó=¥±ãK‰Š<B3ÊŞ)Ş Œê0Ê3¤tjöå®C4+CŠ¹C%./ÏTº?TÜÜÏø¨2 Ù1¥€PƒFQS‹òŞƒŒq#¶(‰h—\r§(ß[?ƒxZ\$Ä®8øÔ•ZJÉª£MD‘4ÆÍ¢›œÍSc•qŒ)àäõ6òtéirœMKW	#háŞ\"Üu1“;_¡—cm×€B½ãd<í«H:ã0Ì6 ,õl1Cƒb6ÆMĞì­aÌ7¥c`ŞÚˆ7¢¶L¡apA\nAè0à9\rôòÒ4	h@€ªš€¿ˆ0Ü‹	âœp’£ÙB†eyn^ƒfHk›¹Öx çú‚bº6‘?\\aAéèV¤7j‰˜†)ŠB0@*\rí3ÉV²8’‹³1JdƒÑÈÚ:£5éu/oãv1^HO™ˆ9\0002?×V»I+ÌûVã˜È0Î2ĞÄ–'É@ÜÖÓÙï)8)ñ&C‘ª‘®ãºlßš:ËögeåÒ48c0z+ã àáxïí…ÈĞÛAtr3…èØ_X1hB@„Uã–˜¾1#1(D_#‚ßißºÜxaÍ°ƒ8² ÛŠ\r¼šÔÑ0rY\$p§›@NTÑ3\n§Å„‡C\"ê	9‘:¡@\$\0ZÉkê3](Àƒx¿Y9[ åè™—–:(r:F(†ãH@Jq:c…lÊCuÀsÎ¡N2&qAÂHMaÙÔ‡ÄtRñŠyF‰286Ü*ı%€€ ·‡>VxnepIJ¨ã©9&íQuâ€A£(z@Dî#„hÎuP’b…ıu¢èÏI“;q\$¨® ĞRYƒ\näpšÌ#(f>ñŒ®šµGBd{åìê’Ãh™\ny¢/îÍ`¢´Rš#’äCÂfxS\n€µ'ƒ¡Š0o)LèÔº\0ôÚä³å¤”°A’-E¤KÇ\r‰¤’i*F´ˆ±ãQEK1´Áš\0ÖRr—nä`Ë±%â=\$ĞD`¨\rP#,›HGHù°…Êi4uô¿!3ËH2/%f/±€/°Œ¯ÕÂp \n¡@\"¨K•&Z>x	Ñ‹\rÁ…&êYZ24>èr\$¦`ò\n´D<8QeFŸ£:I(”âŞdÖ8m†Šr{L˜N?\rE ú¤İ)Ú§Äùª4D·N|`3»Ó¼\r wK3ò\nUÒÀÃ‚PJB‘*W\nÁX9ï\n\r\0Î£f8z€PV0á¥_Uzoƒa*Zƒ¨ÌP ‰À¶(8z«`:¶U¡•İ¡Óv**Ù,ÿ¨™œ‰˜Û0¹—5JX\n\rdè5¹³™,éM‰\"\n¶|J^L±4úQo@RĞ6Uöä Ó_W*à1Uu³óü€@\nbs(šCŒ'a¢§Z {Â¡tR%Æô”RXuo\"«¼ÆEl:Âhƒ1Ôf\$5˜Ù¦C]±.66#°¤Ïã1åkà#hÃÓsFK©…øü€äˆáNx9Ù4Lpå‰¸pæ“éÄÆhÎ\"=&È3¬·!”ö½\0èkq*tÄæpë!Ö€Æ 	Åø‚¹Ìj±Æ*ÇX°ÎãÔ<Æ^\\E#µ%d†@Ş¡âÚ\$w‹\rbä8Æ×c¤nØË#lÕ›†Ë¡‹¨lÀJÎ^È¸Ó3#§8”r:Éfo&—õTgWqD Ì	şœ3şhCş“éÌ¢Bı)ˆU)C¤Î P\$X\\d›˜ÒçUlÙ;Œ³ÉŒ0¤›–ô´½19,ÏRS©ÚÖTõ4§#óNE²òQé¤ë˜‹- Hæ;GFµÎÃ\0R•oÄÉÛb*Œ·ÊİfØ)ÚFÖ­œİó)’­ì4íb6O*áÉÛv´ƒmíš×ã¸»—báBH`k}RC“dêíËŒwhr²ŠµØ‚_êA¨ªÉI×£¿iók5éƒ˜¥-U©~ô²\\6Ÿ\0©¶I.mËhÄ³hgn2¬hT¦÷ ‚€™NM.¥µ}ìİ¿[wÒaµƒsàÛ*çşÊ]üÓv×áÌ«5ã›£h×n[Ï˜XA¼ÁÊóü‚Kß.Æ)Glãl“£6</ù?  Ó×ïQæ¹“:Î¬ÒzÁ˜É„­ãü£Bìå\r#„Ú¾kÌoî·¹®è`: èi³½]şçD;¯é¼(§gèZeÌ8i\":{ı\0C~·œÒB¥7†dÖ´g¢BrŸHÀyO,İÁÊV]	p£¡‹ş˜ålÒ\$ÿ1âYXĞ§ïwÁğeØ0\n÷uİ«¹t¹!¾5>ú\\ Ê˜zeãµ½/ı¸{Î”L)uîö%ø¾÷H_ùÄ3à/¿p?\rşÁ¥7Àø=ÒLğaEıİßò°zŞÿ/Úş:ÁoØıÏÔJ®>6@”°ªæ¢ˆî”lt+îòÅêÁÂİ®ïâ&nÀ†ï²ûpAPDç¯úçåQj|º\$Ê¯`Ş3§@:°dK°HÊùÍ[.D	²\0¤2 Æ\re(àx±+Ú½cªîïÁäÌ½KŞş¯´è=	p¦ÿ†Ûp¤NPkå\$1@áäÿBšÂ\$bNPœş Eğ×	­ÚşÎ‹[P;/Î\"¤j!`É. ·ÀäÃŞ\nàÒ\\˜vDğ²Pvõ	L€Ş\nzÍ\núf1&/\\Tfàˆ	L¥„vŒ­R;Fà&4Âví¬ ø€†CÀØ`–cŠP„0£°×ğ‚.%¢¨b­:ôè\n ¨ÀZJƒ„)ãh \"fÇ'ÒÙj'\r	q(í#2Ï8Ÿ‘¨Ñ.=`în\$ŞÂ%TÒTÄ»kº5**áå60Í|‡D?lZ’©d4„\"å£r6qe–h æ3ë,-Ä:N0	‚4D\0š%-8riö=ä2ÄàÚ:‚XÀ0Ó‚:ÜÂ:vàI@PJÀÜX\"H\"g#‚<a\"ª£%R= áËˆ¯2:Ø¢;Â\0Èh\0á%j]®¤#±\"_§¾è¥Ä^`Ã(#Ÿ¯ºë\nfp)‚;#ƒÀAô«ffD.š‰š_È¼–Š8Fvhb¼a‘²Å¢hG¢è8d°#ğ®§’Œ¶èÊ'DP¶êö215/*CíH2B4’Fé’JG®RZ\rb\\,çnZšG2À½%‹É2ÃXòfµ\0†8dz‚òÜ°†9.(bä‡ê@\rZD‚Y#\"84ÆGbö  ";
            break;case "es":$f                     = "E9jÌÊg:œãğP”\\33AADãx€Ês\rç3IˆØeM±£‘ĞÂr‹s Òv7‹DYT˜Úaa¬b¦ØâE2H%’é„Z0%9¦P\nÊ[/Š›¢¦YôË2†Ìh5\rÇQ¸Òn3°×U Q¼äi3ÙÌ&ÈNªt2›„hñ„ç2&›Ì†“1¤Ç'Lç(>\")»ŞDËŒMçQ ÂvT£6ó±¦>g‹Şâ§SÃx½Ë£ÈüÈu“ë@­¾æN <ˆfóqÒÏ¸”prcqŞ\n)çìæ}ç#u› Ò]üri¼Ş&fÉËvIÁ›æà¢©Ïj6™rà¢1–ZaàgmÆQÂ Ïà˜4 +ğ!<ÃK#Œ¯PÊ:FZş0#¢Ü(!\0Ä¿\$Ë]nƒäÒ¹ÍÛÚäAOë‰C‰Ëø!CÄ:×£`P˜7®#sªß%Š9E¥‹ø+@ÃÈ=7ñòğ³9ÀSË7è¼ :Œc¢\n0L#ß´°,,°¬:PÚ?‚pê2¨¢’BxJ2CCÊğÍóŠñÉñcv#£pÇ\rÈ»Å±®tB!¸Œşa–qÓœæ¤3ø'P còÁ¼#,lò¼QºĞ4ÊÓ„2¼³1Ñtkè:‰¨ÂR,<uD&îj*)Š\"`\$ÏÌcââ¢£ë'…ŒáCj7=J¡/°s Ñ”1O¶äcŒÎõˆld£pÜoâq©½µ\rÛ0õ¸\n\r#M5Æ¢JF·\$ÍØŠ<\$—ëûsLu˜Øş^ìgL¤Øùƒ2Í¥l`@7ŒÃ3É@¦Bå %29FGB ŞŒ#sƒ>r¥49c5`\r‘ÂÎ9…‹ØäàŒ#8Â³»!ê6¸ëÀP9…)–L5²B¦)ÎÈì¼p\\\nÓ8Ø;?ÂòÒ·ùª1£q’T3-Ãm`“ÁI¦‹9 @ÂÀ2;şüGÁ†T§Ğ¶İ¸nL8É*nùÊI¹³ğº.1­ğÚ\nÎx;Am\rÓ:`À/ËÂP8/Ã˜î·N\n à4±ƒ&®?C3¡Ğ:ƒ€t…ã¿l?ú%9ËpÎ¯>R¼£ ^/i;P:u¢úú7\ra}}ı†:xÂhHÃâ:\rT&úbB:#/•rğ¦B Ê12R“~ÏM5I»£:1‘PºdcÌñÁ*‰-â£ œtÓéøC/èÈ@GúF€H\n7°ğAH%CÈÑfV„É¶Â*Ayr&}…µXEÈ©g8aÈÆ%PÂRÃÂš0f¹š7†RqrpY\$ùw!“¾ÈÀp}J4¨f®¸fq\$¡c=r@R	I\"!åŠC°@TŸA9¦Å0Ê»s!A´Èî‘±2ND’Á\\á¨&A@'…0¨¶É22&äpÿ‘SÊJWMN=rRòI¹9\"«:Åhz†!ö8Íqm#ã\nB­/Qa‰¹R\rc5?ä­\r\0@¯cs^à°\0Œ œˆ\$+ì’¾xÔzˆ*#>LuÉ˜|\n!8lQ™bBT\n¡&´B”Î'… ¥6¨mLZ#ğÙ%Páœp´(r÷ÈP\n\n¤#cˆ\\U(\n	áÁ?œEû¢’°}\rrs©åpxa2ƒ2† Àš©\rêX¡Ä­\r†£M*7kb¶B1‹t5\$ÄÊ66ÙC)äwOá¿‘õX º1^L1r†S~åSAøa+j)ô\n¶ƒ\neèÔ+6Æ ˆ&I¡Xù25÷AÓİ•ˆ±©ŠšM%æ9Ún5=Á&R'±¨§õú£XPf1ŠdÄ(‰™VÙ+@ÁL4‡ªzƒ‚ÇSÍ¾—€ÈxèÉˆH‰x*W\$U9ÃléX\n)Aª·ÎÍŒD*P¸ûˆ	g9ö9-&*cQìÅ³ şDç%PF*…’ˆ?j\$*ş\rÓ0D äúÎ-{.q4şfÒ¥B9G”ğ£PŠh\"!‹Îš›øJ[è¼4BåÌ‹£ì±ÒIÄe¬Dş'P^VS«2Á½:'Ä›T=Ú Mzë;°k™ÍáMwŒ•†i5!Ap	Qjõİ[¯Rƒ\rñ¼×Îô_[ï‹©F#\$l‘ûı{—ì_:e¨½5rÕˆjpŒI-?Ÿ…ÂJƒ-í½íâßx­~S®/8uı‡Aˆ°†tˆ0ârgŒBh …tBõá¿ZDÁ_ËÂM(–ÖClªaúCÉ€iC'mãSŠ!@R(&¡pîûŞî7¿æü å…§;YÂ¥û-k¤nÓÎis›©ÜÜB«X\n		±Fõ™Qpêş9fı(`šŒªm%6h†NÖó‚&:¢vNİJÒv¾èºVkšUr|šE»ê:ã)¶ S0w’_VhoBÆî¢³ZÖhÎR‰hCf…—LŞV×Æê¹ØIõû\$ZÔ·(+aHaJ©ºÈS1<ÈÒÚBG7hXyĞ~C5Tj”ìdL©9¥:2îuãºc1RœV§vÑÊx·æÕ[Ú™¶UcÜí¹¤£~n”lÁÉ¹»¿wn@âÇ|Ñ\$+Cf­~¯UÜÁøFn&ÙC\röâÄnbBËF.Z¨!Ú)ÊÆÿ³º”şòç‡Ì7Î©İ¡0¿VK2VÑn²¥èà©ƒŒhŠğ/Gm³>D³‹Üô\rìç¤’¨›\$¨/[nÆf¤!«yìËÛô˜•tk4~iOÑñšûÄükU2a‚Î&â*Cw%r|¾téÍ\\‡’•šZœÌİÚËAÏ¶şËMœÇRj«ÃiW+İ¾=¼o®Á%§‹&w!r­y¤î=ÅÔ|üy¿Eª=-œZÄ£Ğ¬FM½gœ9ëbğŒYÏëw1\$«=ToÕÊK>W7Ã«ˆ±<÷¥^¿á´OEÌ–¶ùç|Q†=UO¿e}”Ähşaƒúª«·4û3-Aü?UmŒÛAºÍh“Y{NIíÉÃš„Jônfÿoîµ\$.úí&ûÃ~ÿ‹`D«>gÂQOüÊÉæ]©êõ¥T¹äÿM'\r ôŒ1rô /ÀĞĞå.DTOÍr<âF¸cvN¯Ô¨ddIlºÅá(`¤ĞhÁZ8ƒN£\$BÂL.‡ÜøP^t'¬ôNBÀâb¼¢R]«Š#–äc0d \r€Vr#‚‰Ö‘ïàsoğ\"ÍFj&OnÁÆÔ'àh ª\n€Œ pÍC†0bĞ&Käãév‚Î/í£ìŒÚÇş*h’Á…h˜*\\Ÿª4’äÈğ`Ì-(­éüD/ [ãØ8ÃÈSI/+h[K†É`ŒËvIzÆ§êä…è dr?‚Ôb\"~Ãş:q\\ˆMšø­kÖ9ÊÈ\$b>UNx6jä#<élº–¤î\\3ŞÔcJ>Cˆ‡±|/­¯êÈtjXQ¤İm>/ÍL#ñ€äÇà2H*8Æˆ®ÇL&eĞ]£øïÎz8\$º\$ÄB@ê­‹\\ßƒä¾ÖiìÜ`êTÎTIñm´­¸SQÌs‰úf‚:1(ãäğ5ãäî9F°<\0îÙm¤©*Ÿ@áMªğ¦ë#¤T\$bCcvMK`Ö‘Š¡€Ş¢cğÖD€CMĞj¡¯†Q¨áEÌ6nsR ®²%r*1E6]Bôí%œzèc i\nÏ@@š	 t\n`¦";
            break;case "et":$f                     = "K0œÄóa”È 5šMÆC)°~\n‹†faÌF0šM†‘\ry9›&!¤Û\n2ˆIIÙ†µ“cf±p(ša5œæ3#t¤ÍœÎ§S‘Ö%9¦±ˆÔpË‚šN‡S\$ÔX\nFC1 Ôl7AGHñ Ò\n7œ&xTŒØ\n*LPÚ| ¨Ôê³jÂ\n)šNfS™Òÿ9àÍf\\U}:¤“RÉ¼ê 4NÒ“q¾Uj;FŒ¦| €é:œ/ÇIIÒÍÃ ³RœË7…Ãí°˜a¨Ã½a©˜±¶†t“áp¨QŸ–lÛï7×ŒüÕÁ9äóĞQ.SÃwL°Şìëá'M¦+U\rİ¡œ8&S¶÷~k†ÈŒ:;–r:\r# &0P!-£äã(Ş6¼c¢Ô¿ˆ(\\ 1\$iĞÚ7í<)Œ£“7 \nß\rÉ2Î(APâß\nŒ¼3ëb*Á0`P”à·Ú!¨`+\$mã® PœàªMû\n¢jšˆ³‰«ë~É\$ƒ(è°’\"ŠáJøª7íŠIã¬¢¡­Pª„\r#Ô2¢<0©!,ìŒÀƒ\$‹£t¢C‘L*NÜè'‰ĞÉ\rÒT–0KY¬ì[2²C`è\nLâ¿Šó\nHÖ5¨ÏëH;U¢0ê6\r2ä‚¢£À\n\"`Z(;h ¼ğ|ŠÁÓÈ¬Ø2Ó€Pİ&7`Â£S°æİ7~¦Ëü«2<d€Ê’²+	MR”Ú&C—<¡uXp°Ë\\ˆ«ğ2 Q†J­v¤\$©Xä’B*s`—cP£VËšßq^qY?ÓĞ[*ËÁIHŞ3ÈÚzšİ‘²\\R\ròáv¬`òP*Æ1°ƒ˜ÍY¯ª9…0å•Œ#:27PA=8¨SÎ2…˜RÚ\rãb©„¦)ÙÈà™P4NÃ4\0ì´¹`êİ)¨¬àä©–mE#¥¨Ü°ª3i˜4* ?c=ªjÚÆ€6fÚê‡²FìHÊš¦ì,B• #˜î´®ÃÅR9 Áp@7ãG(3¡Ğ:ƒ€t…ã¿L\$”Pä-#8_fuãÃX7Pƒp^VÎÌµÎ‹í“5„Aö\08 °€Ü:xÂhh ×\rè;Nâ§	J¤•D9J{ãîlNê7ĞŞÃ4’ ~+~6°Âôšˆª‚½/Í˜2;ìC°Tp²µ‘³N–ƒğ\n (?ÒüÎù»K…!¥°T0ËK”Pf9ˆ²nNIØl'­y´â¸Q#ğõ‚XúB(Í’’MBI&XRgRÙƒ!f˜×‚([…[AÉ‚\0‚ŒI@r‡‹07\0`áãùjæš…\0Â -b±ê9öîuI2‡)±ËBv²ÈÔ‰…«…y 8LT+Mt¤ ĞiƒK!ĞÊCEtĞ\rK€|†ı§p@ÕêÚ4Mz0‚\0Œ *Gh,K4¶¢#a0h‰¶b^KÑ/98bÒSÃ;@?å1AH¤S1o	á8P T *Y‚\0ˆB`E—Iñ”P@ŠI: AA… !\"928T#Äx8*T«²D&eP@ÊOÕš[S­Œî ÷ŒaRnZç\0R•›—é¼#Ä€•©EŞ’2´3Ô‚°UğL‹ñpP(Æ\0±…ä½™5FŒwÀ2jŒD ïz\n^æÑb!0²FÑ˜PˆŠ5ºAù“Šå<áÖ	ĞTÈ´uDjğ§šÎLZ&¢ğšT8ıe6)—\0[ÕB\"ÁU±Æ¢àper<…Å‡ ˆ“ CAáÁ£¿b\nÍb;ÍÄğ¤H©*‘o\nÓç“ß/Í·˜:¬U¢ª 5ÏÁ>˜è\nd¸ZÊŸV\0¤8*VpQ3ƒ9¤IŠÁóåb…%ŒKP)Â(RLK\0^¦<Ò d]°\$UAHÌôJh)‘ä,¿’àE\nÁ'@¦˜¨YïaMˆSš,É¬Ij\rÍèBP@>N €‚¦Z¨\rÉ9­µ·›²ŒÎCi/\rTXÃ?°j{	v,5˜ò¨úI«D²÷*CQ²CZL47”ªäòAï™Í<ôAú_t·~E i¿t\\šŞ¼‚Óq'Kq;‘b˜Fá ?D–wátJg™„Ãhª\rĞõîHŸ[ö“…¨åar*ıÖ­J;·é&­¢€¨-Jøæˆ¢zrO!Ş2MxŒs7\0qÉ¬®æùô7¥@LÉ¸°Ü—ª¢ÏXÏÌ%q¸SkS!cl%÷u¸Ğ“ºœSœu¡÷Ú‰”\\+L_Í—âŠßÂ÷U<lI9 g4¶qŠ¢Z¿¹Á‡g,›işƒÏbh\0ª@¹Ú-)Œ“’GØ¦½\$\0£^ú)™Zx©SE\r¨ôş¦™èªÔÙ<¿€Un!b.A]\rD–KƒX§Y*b8YäÔ˜ˆ†C…RªÊ2b	Ú²àĞo¨¥dÍû5ìú&G[‹¤ùÚ…P}«šô:ÉpGAíEêšSZSlY‡-æ<ºÜ¨íÄÏT3àô›kĞí±M†™&Ä5Àt¼ŠòH|€oCC£|ZÊk¿÷Ú9g¶{Ãl:Şf;ˆí\r¿´°Ò€qİ¹ØLª°ŸdnçÌÚ!àÁÃ™\"íR˜e<¹csµ¯ÎâÜÓŠ¥œ“®a[4\nµæ…ÉòÏóŠpNÅ;!ZÌ\"›—#\r;Öİ/›Qp¥ËS)“Ü_‡'ÓçÁl±Ês«ìM(–Râ^L\0§k,? ¨Á#ƒéu/¦ëó®o¬İï¹wîM¸´O)]¥èw¢Sß;™€¶ÈÅ†x´±Mµ–Ş(ko-ºõŞƒó^s¿³^Pâ0sògÎÆÕâØgªó~P‹uo¥À}K•^hxBMÒ÷¾ÿ-,‰Øo=—¤&Dƒ|RKe¼üØâš‘oš#º¼ö}Ü9ü¾÷ˆ«l>¿Ğû\\Kq¿H,¹™š‚Ô\n•W0áø>yg¸~1m(¨wôıÿ[çç|Ì­€ØK±d\0½¯¢ğ,S\0k3\0ªÏoJ×CVĞj˜ K/\0…Tô¯ÊĞjä²Î¡eU¤ ªÏæa+ËÚ8³Ë@´E†?FöƒÊ§C§\0ï0ĞdJ¸ã~û.\0ãÏºÅ0nDã~óìÜÅ ±bÌ~\0P	R È´oàM…â[©üe Ø»/À1/Jélìpš¿Ê2~ö¤‡¼±Äôî?LŞ	mÆ\rÉÊÙÒÇ\nÎ&Î	bNBê½)<ÕÍ68£Èrj\$\$\r€V\rbfMò!¢–‘oXKbæ®‰j\n€Œ p¢\0Üg¢9¨`’†*B8h‹°\"jÑm0&LH%&\"İË¼\"À›àÌ'ì\rëbN>/æÏE©ƒÏËŠ<Ä{£´æÊ@`ÊR+ò#ãœ4\"b;…Ø\$……d~”èk)¤Á\$Î±£LVeğÖ\n2üÆLìùj&Ø\0ĞNoBï\"6~	bĞ„TIğÍñEìü!\0Şæ…0â±I\nÓOÆÚ¤à¬îVãJ3#6æ‰‘æ@N«ö\neĞİ\$î\\K\nÂ—AFôãj@­b`'ŠY‹ÊÔÅâI¸Øé°Ö*êU	®U¤ˆC|(i’\nN&ÌBb7!@@\nÈí(r\\—€á!	Š,ä*&N„QÀ–|\$ ‚6ÔdT‚Ë‹Š,4Âõ¤‘#)á©Ë„Úg(É¨5’h\r2l4 Ë'@‚7ÃOä*~\0Â7É`?Ş	\0@š	 t\n`¦";
            break;case "fa":$f                     = "ÙB¶ğÂ™²†6Pí…›aTÛF6í„ø(J.™„0SeØSÄ›aQ\n’ª\$6ÔMa+XÄ!(A²„„¡¢Ètí^.§2•[\"S¶•-…\\J§ƒÒ)Cfh§›!(iª2o	D6›\n¾sRXÄ¨\0Sm`Û˜¬›k6ÚÑ¶µm­›kvÚá¶¹6Ò	¼C!ZáQ˜dJÉŠ°X¬‘+<NCiWÇQ»Mb\"´ÀÄí*Ì5o#™dìv\\¬Â%ZAôüö#—°g+­…¥>m±c‘ùƒ[—ŸPõvræsö\r¦ZUÍÄs³½LÂv4›ŒıK©\"ÑÊ[˜–±GXU°+)6\r‡*«’>Vö2Íz˜'esÎª *ƒîâ–ˆrª…”èé¡¯Ô Ğ²oë²Ã!JŠ&Y¿Ë¢#\n \r*FÉ–(éÂ¡”×%I‹¥&î»¦õ¤ÑB:_+©k	À/éÍDë,ˆXÃ),ƒ¬:¢U6©	Q%%rTÙ;‰*°rƒ.À¾\n²s,3ìÓtÏ7‰+\r&ì	D¿Qk‚W§È°ÈõMPÎï¬ó'Erƒ)0/ÒÃ)=t+\$€°*ÉêXÅìl\"‚-2„§³<T©±ğ›‚(ğÓÚˆ•L\ná§#õ—.½D•Õ)Yg!z B¸“]BĞ¿1@@)Š\"dœš>“CzÁC5ÒFÀ¥I	eN1Ğ[¢í9ë\$Ï,›1ã=*«l».-•-%rê`Ã§t³(K¿x6²ònÇ®µÄş?ÕÛl•Ù(tˆË²–£û¤4{Î¬Wb#w,Ó|[÷Ô©~Ho´A¤ÀPä:\rƒd’”J²n® èI\n™OÍã’ÀámT¡JêÏ]±ä\n<”Ë8Œ‘ŠúşI±”TñòI‰[zƒÌHfƒSçtAgŒûhYgèƒ>IHö¤N„f”’¿ZjC§ÚŠ\"ŸB¦)Á\0è7c(İ› e4§VÈp]²¬6ŒO¡¥Êe\\eóöUœìÕBK=-åNµSğl*„ÛÉÜtJä,lh9:«ñlé²x&\"ØÜ»¤N€ì	[QO‰ÈM¤+ÃÈ³J†’³¡\0x0„@ä2ŒÁèD4ƒ àáxïí…ÃÈ6¼#(ä\rãÎïß@ğ:oÃ˜Ò7ÁxE½?0Ê:zBøÄ6#pÖòİtF9Æ0 xaÈ¸¥©Ôn—™#)\\Ì\\‚X–Ê›/_4‡‘¢AÙbÒ,îx‡'„(m‰š8*á¥&è¾ÃEe˜¨¯ç}QI\n\"i\\”³¬œ¡„Y=¸»¬ĞB€H\nÍAÔıšx  ¡‚—&XMY”j®(¸£cÎQ!†î)¥¢V+º,GXœ¥JHyMiiA\0%RfV`#6 ‹¹Ü¶öZ.I+Àpî¨ı” æò4B*fíe¤&^HĞy\ráÔ@ÒÃpo„m¿'pèL‡yáÄ:†Pç&Ã0r\rá´¾øC“z\r\rø0ØÃ˜e–R„\0ÂÃ,nQpQàšä¶d!ÁS%¯	Ã3òÆœ’	(WLÖFÃ¦æu“#è’<x&z;¨æÂ¸²Yìng(Ø –TË1ö'Ğ¤Ïõˆ&q6NO%Ÿ#PWšàF\n‘-×#æŒ<AIetPµî¡Î,4n(\$ˆ2ôh¬Ò6J'4´iÅCFA<'\0ª A\n‘ÒPˆB`E¥j}]®…§¡©\0‰Œ%rÜK\nUiµt¯úxÀ¼Û&…¯ÂÒ-”)“/DDV¬wŠÁÏR\0=È)øVJZDmÊ®˜Bp]ƒ¡†ı0³äÅ!Û*Oœ¨ÄŒJİj\\>Mn˜DZ®q(\"V”ëƒj®Uù‡ùNëŠ?˜!5§S~aIiMåz‘Ò”ÑÒ\$	[´à§Èh®%HfØdÜiUĞ†TÉÌÍeh\$ªÆ kZPÖ„6ä˜÷%\nAH˜’¬f¨D÷¨»=sXMh¬–)X\$­sOˆJôQ2Üšˆ‰!“CÈ½!u´v¤a¾³„Jò\\»<TIQ€f§öí^uÌw*±T,¬¦‹Ï:6hî,ÿiWºE_¥ªÛ0¢?\ne–‹x(“ƒÅ£µ¶ì˜\nğ%'Ë×5ú»c²Î-(Çšsg8¡aÓı;\0^[!<4âÅ=§ÓL³ñIŸæĞÆÏÉĞ—F3Á„í@Ê\"rú,4\"d™ìyÍRICÆ¹º6LsŠòa!Ç²&AŒ¶¥È\n¥C)Ã ¸»GAIru%\\¬Ü.‰yÈŠ9{“CÙWÜ(ªŒ%N†£§~ÊÉ‘Jdò‡\"’W—ÍNl+Â¨œ6`aÃÈ¼î^)v¶@“ÜM&×`EìŒŒ;§#)Óï}İMèÙ7'\nuvR9Vm'\$bdİÉi˜äê(åÙ½­ŠTs9vïV{uR¾U†æô.}dcÄMCdSM_²“i×,3Æ«Ê¼æÉ\$©¤Ò§ÜƒI<åŠ3ÄÓng5ºU=î®§«sŞı¾ÚV{(†wµlËî×¢’+vö@o«ØRÅš&¦ä ;åX\nv²M±5í}ÀFvv®óâv/d39©\\ç²Xyí8í³ùá²nÁrê7±95å-£jR	)ô`øYØ•úœºyî¼ºÙ/{>Jã–È/¯óô¹ĞYcÀè˜ßpôrCÒv}ıš÷ü±2ÍÖEM—b.c®º[z{bÒŒŞ«»ö%~eGÔËJ’69»¼\rC~§èOl!+ÑWÅîºÒïì˜Ob’}VD3—åš÷©èéÕ£.Å¾Ñ×üï™ÙÜÇ¸XOID“!¼ç×“ú	†›œvó{;b{\nçÛ¶§(ìû;Û\$î}êUMÃ`]0\rDšR’Õ„9EÃˆ+OØØ”®g}¤~}]fâúÇÚóÕ[îÙïİPûKXÿt¶øö¾)›f³Òåz5»Xù~Ÿ(…ı ÏğDÿÉ^1”b…£¬†fRj\n‚QDdmm`Ò\rˆ§Ë\"Ü/ÀàÁ'ÿ;í7‹ß/ñ”>cdSÄŠÃcøñ–`„bûpsŒDÒ/fK0\0¢ĞJ8°N7orØ‚Nğ‰ö@¤c*ƒ°@ŒM*BOˆ,@çfÈçë6CÎæ¦íÚ¯˜)aVòjÀFåV)Ê.È(LP7ã^Æ-€§E\\éLjd\\E°ÂêğÆ°„bP,Ypfö	´-	j€ä\r€V–ÀÒ`Öˆ ä-ÈUÉèĞ.üšàª\n€Œ pw¢ìlZè°Ê”Æ.¨2'dã-îpn)ä£mÛZ×ƒò²ĞŞÂËwÈŒ´pZ»¨D1B)MüåĞàßñbí	ê!î›‰˜?B®âÇ!Îğ+ c!D6¤dX–(ìğŒŠÍLÜ%‚& èBwÆÜ…HJ¸ƒ>@hrÕoú,ä¼]­ M¹cÔÔ	ŠxØ±È°¢<ûNHºÑÓÈF‹f×«vÑäï¯\\`ë	)ã~iĞŒL^-?%CˆóÉë+˜1¥5fXîIÀØ«ŞÛdtáÃˆ±’4¬ñnàâX06„º€q\räôBlvTïèıå šÎø]¤À/ TJ‰\r­tÀ%b‹Œpì-¶²F\räŸ±–%	Ä²2åQŞi,Š¼M±èqéÆçphöRTğnæ?ƒÜA4ŞÓÄ\0e­‘VM0=`";
            break;case "fr":$f                     = "ÃE§1iØŞu9ˆfS‘ĞÂi7\n¢‘\0ü%ÌÂ˜(’m8Îg3IˆØeæ™¾IÄcIŒĞi†DÃ‚i6L¦Ä°Ã22@æsY¼2:JeS™\ntL”M&Óƒ‚  ˆPs±†LeCˆÈf4†ãÈ(ìi¤‚¥Æ“<B\n LgSt¢gMæCLÒ7Øj“–?ƒ7Y3™ÔÙ:NŠĞxI¸Na;OB†'„™,f“¤&Bu®›L§K¡†  õØ^ó\rf“Îˆ¦ì­ôç½9¹g!uz¢c7›‘¬Ã'Œíöz\\Ã/;{ºíxúkG'•®œ,shy»¤f3a}á¸ÎîB«¶6\r#›'\rãhÄÊ£¢ Â=ƒ@ÊÜ P†4&\\Â£¢d\n#¢ü4Á€PÉÁ,šÄœB˜òç˜eCu¡Kq\0Àp,	º,R¢¤µtMrQ ÈÜÉ l\0ê:BNÓšÁãKÄÀÊ,¤­J®ËX†(l+µ\nˆ/Â˜˜6	L•&#³*µ	+£bzçLé\nLSÇ+¬\"P;@Ô§4'¬:NA«R6˜ØÉ½¢.2xÆ€HKJRÔÂ:)ÑÃ-/+\rÌ+¢#;5³6ŒìÙR3Ë¯°¥QN	³Ó%‰\n_J˜eÈ*Jà22cf‘Œ/L<6¶¨˜ì¿ñâR:§Ã(ğ0Sì)ŒvJ¤Ÿ ğ„äŸ9­f8¦U\nbˆ˜ÈXÔ„´¨Œ2|*İªÉ`º2Ó›¾ËAÎ)èÅ#[òMK6`SÚ¸˜¥šmH0µ\\˜0ˆæ&T¨qn6¡Û÷a3YS&Š\nïG•<š×H¢\"‹!âóër,àVG#Èù4›\$ô¸Ïº-FİjPĞ—5ëã\n–,•kT•úÆ8[îÅK¬UtiR› ó`X¯YËUF¸rÈ2Ş©M’„Óa˜7Ië@`\rúä¯0ª.Ãbé÷NN9ìèæ0íM[~mÔVáj›˜AºîûÈæ\nƒx×-¦)ÏjË).¨­	¨	;VÊÈ6Õ8«)pÚÏ!ìªtÀ³C*\rh‘ÔŠökI›<mÖíh6—zË2ŞÇò-Mê«¥hß¥\rjF”'¶°áä.¨x¨Ì„CCx8Ax^;şpÂ2néÊ\\3…ò×úµÒÑ\$; ¼.@äËƒ£ìä™d†°D™‚c‹ÌÕÀ^Añ1'¡µ4ô€U\0a&†e '`lê`Y+ÌÑ:Â‚ÚÏÑÛ5.Ğ„ gˆªÎT\0002/°–5¹Rq˜h>@#\"€H\np:‡b›\0(*„PÓóÉn\$§%'=¶—	™p•“½‡ ‚P[Ù(„°:†Öº†	O9ä¤É½ã\$ùA«¯0Õ¯PÎ¤IT'AL4‚œiM9©5ox¯;ŞL™\n7h@Ê®…Ô„\nHpd\$ ¿‚ C9GjÍ06³Š„\rk.j„…\0Â¡>k`V¬’’æÁ\0R;òmµ®2Ê‘±•ŠUjGé\0j×§ZP|Ø¹eÆ×‰¡ÿJÅoÄ h!¬mæ®&†ÀŞıØÁ™U¤ˆ¥•²`»BbA+¡*D³w#LêÍ&\$¬–’ò»&dÛ#ˆÕ ‡ˆJ*šgù¢RÂCr{êDğœ¨P*ZCÂ E	Š¨„ÈIéØ›Í~FàÈµ\rlÓƒ‚ Ş«ğòrĞ;¨Ü'‡ÂGB±GZT¦:\n“ò“Ğ²	R.å2&òí\raóC@5QR‘ûÅ:}!ŠSªú&Ì×’†F}ÏÉûHŒ!\$L2 éËÁh'e)Ÿ›‚ÂÜ:•;Mˆ:I;–pò\rP­¥M?dµÁ&³„˜Îªõd­é-Ã“´?êJ–qD S•‚¹Tù ¨¬9De¿Ó—!%Ü†ÀNµˆ;KÓZÑEÔ£ÃL‘t:¹¯AhJ \n\nPŠi¡¢¶tBJcT%!Z,Â¿!ğ½sm}Œ602‚€æ\nQlM>D°Ç…drèC\rôŒÂ™’kb\$ˆ^tZpÈZ‹hUA'ÃQ™ OÄ*	WJè*©Ô%-+cp›oÄá§¸7`cøNÍ0I…yŞò‹FAöépÉò:0ÄHvF&H ÙXÅ¬=ú3)< #¢Â(r2¦á¹DuÇ%WKMR`€‚v9…SJS !Ëtd³MxË'¤ÈBjCLa¸‡/‘“Ù`dÑ&à¹ñÊZÙ2º²|¨²–TYºäR”ö˜rlwf\nı€Ú˜RÌm£“¦ë\$¹(Ïf2¾¡šr®^Ïù#0”­“k‰¨Íw)è“¤3!Yk6²GY.¿,e7¬ ™=ŒÔH”˜Ec9CN\"Œµ42É¤>0rFÊœ¦0øAIçŞºZA\\2†-/¦jF¬:!hºèé±´øÉ0#´|'Ù¸ËÎõ•í©ÀPHCåí|Ö\n´t\\êOnÙoSu¼«™=EUÚíW“&U÷p©‚JF×I#œ÷'{ç}¯8A¼…Ne=±İWu\n¹wîó%xü¬ºNøygâ<'îÎ.Oá2á)xŠ.‚)1(—Ñíbö“N°<ê§´ıI\0Ã…î™0¥ +›s…HGyE Gn0Ù^ago2ÖİyÄT¹º]L	I+\r×ºñ^BP\n)Ñ7c”q‹b“U„!<zW‚YÇØ7`aWS±ïî&ì*hëì’²ö.7Éwr°]×¶w~;Ó+U†dö#¹´ÃÛN¤œşØ|vÙßdâz?B¶|Û–z_Œ 'xù?ß¼˜ÏW+éìƒ›øõ{ëÔ&HĞ%“€A•ôR°÷/YÄıuö/ƒ·yœ¹¬ù·¿Ş¿\0û>KÇÊU\"jõ¸_\r÷&ÕA¿XíÉ/ì¶FèŸRğÊÙÊj6€€<äÿ¨Îmç‰šwå5ÿ™-ş”a=‰§µÅ\\~Š	'ê×6°9ârBËú÷/`2«”ãBîëèİƒ,Á/ı«Êä\0÷\$÷Ëbø{of®*Ê0ÃºøÎòÖoœ\$ş@\rN2lDHÛ\$‰Ì¯MñLFÛmâ÷®\0÷ğf0W°o¯|«ÒOŒTlP{Å%¯ÑY	\nšb¨İÀ“ã¢BàÂÜ«Ä2)ø+¥Ğ–ÂA* âN¼óÏ\"÷ªî»jô­O:Ã°Ë°sğÔñĞÙ8âp‚­KêaåÆÅRè°òP‹#ÊO\0Ğ”ÅGjÁ®‹«ö>E,—p\n¼[ã*ƒ†­l\$ìBLiğÎŞĞ„+.À±4+°_\rîˆlq0ÁĞD2nïÑ,ÁËî\\,QWe~¸ÀàÃìCªÔìX@‡åĞ7±Nñ†ÅÅ¥¯Rß—±š÷°‚'@?@Ğ2l8Å‹ÊêREf Ç>Çq!bFyïzæã6]mîÈq²b;\"£±Ô’ã8ŸÊF1æên1(!Ë Ù‘ÖfLvİè'ğëÑÚn²ÄªårÎšŸÂÄ\r€V¡ Ò_#V3¯™Lh6æĞ+ÙI„ÿ±æ]odÀ£3‰¢\0¨ÀZüËNöerÔL»Ìİ*ç²n!¬ä#ÂZx4Hîh®s#å\rf[®ŠVdä¦à\rã@LZ@ÉåL \0E*€ä€²=\$ˆ’dşèâtæÆ\\Xb‹LBÄ0€ğ\nÒà> Øinøa…\\3£>Aé;m4)R—'’áBÄ;),õRDä\"•O{*³Â{02†û13)1+k1\0³*R·¦ú;e™Nœ[‘²c†*¼Òğ&#¥fVË†Nj«³&¹\$|Ú¥?Êfâ”ş«7îµ8Iæ½¥¬:H°«CÛ1´CÏN§B(lÊ²ñˆI‹*­*¦ÂX@£,\rÂEëº=æ·Hêæão€Ü_#¢«\n¢«j¨¿g öNö±f>\rÎ¨'ÆfæsĞ@S®\r\"@³´	\\¨€a§´ßƒäX¤\nFÜ\rÀ";
            break;case "hu":$f                     = "B4†ó˜€Äe7Œ£ğP”\\33\r¬5	ÌŞd8NF0Q8Êm¦C|€Ìe6kiL Ò 0ˆÑCT¤\\\n ÄŒ'ƒLMBl4Áfj¬MRr2X)\no9¡ÍD©±†©:OF“\\Ü@\nFC1 Ôl7AL5å æ\nL”“LtÒn1ÁeJ°Ã7)£F³)Î\n!aOL5ÑÊíx‚›L¦sT¢ÃV\r–*DAq2QÇ™¹dŞu'c-LŞ 8'cI³'…ëÎ§!†³!4Pd&é–nM„J•6şA»•«ÁpØ<W>do6N›è¡ÌÂ\n)êîæpW7­Ñc\r[è6+*JÎUn\\tó(;‰1º(6<YB6B\"(‘\$@Ò23°\nVÖ<‚b‚í±º(Ù-â8Ê’©-“¾ ·£ ÄŠ+k{5ŒpŒ”5Oëşa–`P””0Ñ‚qÄeJÄ%\n¸àèB(Úú0ƒĞôH¤*#“¶6\$¯\0è9£ZTÆ»âr®Á)H™f’lÂöïOŠø¿\"Q„Á1;®ù†M\rI\n®¬À(Èƒ&ƒ ;O\n\$õ>G#Pè	m›şş Nè#£pÖ11€Öœã:3Åè­¸Ì/¬r9\rÃÀ7Cb¤\rË›ú¯)XÖÂ\rĞh×R*Å\rÀÁì›R‚0Ï)ŠXµµF\rƒc†â„˜Æ0Ï\0¢&6m˜¼§ª6·Êàê‚¿Åµƒ 2C;F4Ğl“·ÑÌK4Ëè\$ØŠ»âš¯l]“[36¼šbúJc-CL‘Ó8Tí°\n\r“húãHê6ô˜’6\"÷Z­â(ñŠÉÓ*(¾ßsš‘ßq‚-ã]ŸÑ”±Í3Q&µ£xÌ3(RoB¾‘ûê*\rí}°Ñ„hæ:Œc\n9ŒÃ­(a£pæ\$#ò˜ã\nîksàÚ»ÚÃ(P9…)¹†DC²®ÑÎˆ@@!ŠbŒ˜Cxİw^å˜\\	k`Ø2NïPä˜Œ2=~ùŒ8¨èÀ+”àA•g®‹Fc\rÌ¤„\r°Õš£*Û9Ò,ƒ½%ĞÕÁ¸ïâ²9Z#˜æ;Ô“¸Ë*@É½‡‰ˆĞ¤ÁèD4ƒ àáxïã…Ù6¾…AuH3…èG¢<+:Ó»á†9êO|/äpDbcƒmsà^0‡Ê[\"¤Ô3º0šâ”ŒZ’§¢\\§,B\nHe\rd(5‚ÆÒŞ¸n&|7=ĞÈUÎÉZ5<”4òƒIÆ1ååÇ®B4eL1ÏƒdÉµtzQÌØt3©É†ö²@Ş \n (A×WIË€Å2‡2>Ù›Cj-°Ëâ`ˆX‹ü[ğŸŞŒê5…¥*¤âäŞÒÒŞ%	İp™óa :}ÄÜ\$‘òiÁ\0dAf¸¥CåRpH!ÔÂ” Ì‰( D,ÜÒ„>8ºMÏˆºXÄZ“ Â˜Tˆæø¶ôÂ-•yÉiİÂÉ4ºUÊAÊs €;Hf®·Vœ}Ç´ÿ•eîE\\X\nf@eÄcv”10 Á¤3‚\0¦³É‘µ5¦Ğ˜„`©\rVbw'¬p¥.Be	>m\$j27»ƒ[NZ”ƒšÈEÊ\na^ç-Y˜âT-™Ñœ ('˜d \n˜e5Œ!igW<g™ñ¡ÁmŸ¥x§`pR\nI†PÌZqJ”¡²:S&eC8yUe½¾Å è‘aZÿ@L™|\"°ØIÏ \n	”¤RE±Ø]å½³¶–Öv¢,]E§²ttp¢ØoR–š°:nAYSje…|&ôâÉ©ò;Ç`<¹c|Ä@PV?äÅ‹5&0Ä\nÅq!½A”ÉHFŠÚ0ŒE1ªC0¡XËy‰g¦²´(´18¡E¢3t¤¤Ì_H¢“\nd2€ †IgáY<X1•ÉI‰ b#©l¤±äÎwçhzà(\$ª—g\0¬¥–Õ¼&3¿RÃ’ISATÕgTPIšÍºl†È9F¨âğL¦ÉJ‘«g/ë¬£DRØ¦@lÍò³`\nÀ†©	òAIkz añ¢+¡a¢Å‰ú0WiŞ@ûeoÕ4º6Á®P*£¢AÖj|å}>`äÓ½î¾%RR(yJÑèn4·6è„¥—ğaPR•ª^ÕHzJ9w+/\0šGy\n=æ‡WìÂ_ØÙ˜¥ß(0QIqx:ûáó„ïá…¿Å_\0¬p.u˜€çb\"n‹¼ÃA¢T,Ö‹ƒ2Şöâ’xïÅ&õHTâÜ5H‰ìÎÜ·„bh±©ç¤ç.¾•®L‰FZ:ÆÚR,ÂBmpÙ@( #:€¸eGNiºÂ¢±Šb‹Ëí5àË¾o*9QpÊÚüw¤i©Ğåş»<Ç§Fƒ±§ÆtJX%q‚:F9J‰—	Âr+¡9N‚V\rcü”Z’p:äÅªHizNzƒ£SO5	{d}¿Ó­pNuÒhKÉ‚„ê¦>šáHsbÛXív…IùbÇüÏ¢°l2Ip¥J”a˜PI¡Ğ4©ì¦a\"F%Ñ'nU#U·fä y\0…O:[·ìÀAHåÜ¹‡ˆDŒB%!¼»fwêrŸknÈ`ß<AF” ¦Åíp‘êB\"eòÄëş0oC'§ç¥[oX%·Õ2ã{\$2ì½›ÊxÍ326£“k©ÌœË\"_Ü|€ÎÁù¹›“B>€+C¶ÀØÏã\\z[\\=¤ã;}:a²éØ¨ô^ĞzV2ÁkËTmæÄÚ„šöæ®Ï5Üj³œ×³Z¾Ók²?:åÒÄ¨*KDt!Ğc‚\0€‚Y.ÄCwnØ‚p©ø˜E×Š6ÔF\0¶¨L|©XŞw±¹f³ÿògŞ5CĞî®à•p¥qŸWáZƒ´Â,Y«Ú;x¯Ş`ú¤Oê¦“»‡İº7w˜	S±’}v÷Gù´ç×Ù¨œı1Ë;Ş7ù|ä¬2>yl¹N*º_K¶”ôø©sØ¼\\ÏİÓö	^Íºôì;Ql¿ŸãåŒ’Ù²´°ì˜{£Êß‚G‚N2ª&œ®\0ã:B¶Ô\$¨èÈ×ä¹­æÖ'0\"koàÙ‰bQ…Şnæ¥c¾ ØsaBïğF•äÉİï¸_¯øLMTÿo¾L€¬œ ô;‚:\"^ÛÂ®Rm€¶‹so¨j«p¯ìùÍsÈû­š\n u›‹n¶§Y\0;ëTA¯ò¥íB¤ZK°*Ì€§/Ëk¬EË²È›,À\rËëµ\nIb?`æ3kë¤‚¢ä‚î¢j£ƒVÜå4O€Ì©Šœ)Cl•­^/ëçc³§2± 3*yq[~•ÌÒgpĞnê\0%m2ÅHŒNËí*º~MfXÌhì¬OWN›‹çîÆÄ-šd¦\r€V\rÊ€¦ì—Jƒr\"B.\r ÌjåÈ&àŒ˜Gúb”t†¶\n ¨ÀZqš¬ˆìI–bÃÿn–k†)ÂÉdìÔ#Â@\$BH\$\n‚PèBY‚^&-‚@ãË±¹dz-æLèÓÃPÌ?éU!#ª=‚”¯T`¨0HAR€°¯‚(_ân;z@¬;ÂF ˜\ræL<jE%H¸TƒZD\$ÜÑR„‡lºDºZÌüù/{c8Š9LÔ®åj€¤3h\"Ma(@â|\"ÍQ(mÑÔ×˜8¢\n5H& æÜáíÈkãvåò&)C(ÈtúÂ²Roü-ÏN…Šñ,åLY š«‹ê	©@±«*á%BÓ+¨Y0zTË²+&	£|#@Ò\", A`Êê¢ Æ¦ 2¿1B?êL#ñ	ÇA±	CVLEF“(%«4%=+T§åL-a5r’´Â*¥KF)'GW13.IHƒ3 a8+ Û|dÏXk„+Ğ-af¬@àx`Ú\r ";
            break;case "id":$f                     = "A7\"É„Öi7„¢á™˜@s\r0#X‚p0Ó)¸ÎuÌ&ˆÊr5˜NbàQÊs0œ¤²yIÎaE&“Ô\"Rn`FÉ€K61N†dºQ*\"piÑĞÊm:Ïå’Á€Äd3\rFÃqÀäk7œÍñàQ¼äi9Â&È‰¦…¥É’Â)’”\n)Ü\r'	ıÖï%˜Ü%…“yÔ@h0Œ¢q¼@p·&Ã)_QËN*µDÑp¨˜LYÉfÛ„ë¶iÅFNu›G#Æ[ñÓ‘„ğ~Ö@¸Üp›X,æ‰'\rÄ¶G*0‚ˆò4à\0003Êb3ƒ<ˆÙ´ àÇC®\0éo¶&jYÊ[“öŒ¦øç¼Òáj°ÚÀ\$ì“ì(#¯+¸ß /ø„•5\r#²&¥JÈ\njË.“©Â:\nØÒ’B@P™£({Ş¬½°ª1(ª[^Í»Ñ|bÕ« Š7?Ì@äö„£\"J¥;1ÙB2@3®.øÎ93°€!± Rü§¨„Š±ú–„·C¬~„Äãjş('SÈÛ\rh‚\$€»¨LC8\r-Jô3ˆòR8D	:¥¤‚˜¢&BZ:0)ø@'â2¸C²ì®.,¹\$‘ƒ’Ú)`Tl’cZ®ìˆC¬SPÔlE±ÜJ(3,Ú^2BK^·B,Ú8W,R¼Ç4Œ ›D£„D4CcŞ1ŒrbÉã0Í#Ã*YC\r•3ì*\rì´:7!AŒc^9ŒÃ«Î6\rã:9…ŠˆåpŒ)^ò\n6„ª°P9…)e¹Q(¦)×ÀÜ;.h˜\\	cJŞ6ÜJ\"r3-ÊÄ9)©; ¸¼õ²˜µ©|êÈ)7‚QPì2Š¨—rY*É’09cºİ!£Å(˜xx€Ì„C@è:Ğ^úˆ\\¡LÖ®8·áz;­\n°Ü¸­axDÔLğé¤íZp5„Aõl83Ğèã|£7#(è4\rò,TWÂ48Côx–ŠÌ–Úy3˜·\nÖ©ËäÛ¯.*Š¦Šæ¼jüì×P\n;ÌŠ@ ›§+ğÉÅ'!BóH£l9sË²X Í¬ú†Hú%£jˆ’Gê„;6¸P3§Iâ|ãVOR¥‡ºC“¦ÊQ]£¥‚J<±©Ô„Ê£\\jÓ5€â:¥èĞÌ9?\0‚2j©;L„ÙÆı	²0gœA a@'…0¨ìÊ\"Ù&dÁ1Äyª(%,Ç8@äI b#ÄÄ¢–€ÜƒIzÎeî,ÇÂÍ©¢]… ¤7˜ ‚` „p¢‚£§'	â+ÀäFŠT2~QÆ‡\$µÉ\0cN¨@¶‚ˆ“BxNT(@‚(\nŠ €\"P˜bÀ\n	Á…VDãù£\"Zƒˆuš»ò:¤@nME°'‡š(f+¨;ÇØ¡Oá>§Œ6©‚Ş‘É#\\f1¨’\"˜‰Ñ:gUªèÂã:ÒX¥“0äÇÌÙ:2P•¢«PŒ%ª˜)©S'Q‚?GÈú.üi\nÆ%@¦RÏdº\$ğ9ƒ¦ğEIµ®]Ñ§WJéÊ:B¤UÆ£í1¦ˆSJ%<„„°ßÏøT—§=+@†¡V@†p1•`É\$¥\$„XÌXñ—©\0»I 3,ˆ)ö'á€x\$˜û3°õ”¹#’5Ä˜–\\Kb!g¶qHRŠ±¨™ã_¦Ö-ô>t™Ic\$d%útAo@!¤õK9T¯œ	#á¸ì¨b`ğÎ1sŒ€‚†§âx §èùH·Ø[äô \r‹Å}KPÍ\\\$Gá¡b†Ï‚€\\Hñ\räÔÅŠÕC§µ\"‚T¢uWÛY8%*ã\n™bğóô”ZMSéIdˆÈ\nîTôlQ5ª—TˆŠ‰i4*ûpÊ›Ã¿­ª*¿‘\0‘ ¬@#]QSs®BN”‹5(Ì6(«;N«í%¥„‚›âœ\\CA…/±Æ•‡@+#Bœ¿J3p_-Âu¬¶ìAibCMÀ?Å¤ÜBürLaœIŞá²	E\$å-ÓG76ëàê¦½»’„¿)\"2K#¬XĞQÄ.a=Gy4CóFÈì7×Ô©\$ÛÓ¯µş¾\nÖ}¦ÛÇoMß\$u®7“iõ@l÷~  ØG0Î\ncB“r¼İ[ÈŠ%!MXjsÛ«»IÁR{wIÌK'îpi¼ÁÓáÌN°UT•h¦W,IUO*4!4˜©¬ğî)ä]Õ,£\$*œMª„Éª`¸äEï‘Ê)~6&TÓ”	=Q\$UMBĞâƒDfÁúRÔ`İ³9ÁÆ÷zğf\\ßCó–j'XÍkÍ÷â†d+ö8ä>ƒ›S ÛÊfHä¬‰^„ÅŒC?DM\nP4;‘#š)D§R„1ñ@‚Hü5)=0ä	±w‰ß8–Ë´yÉ„Fªb…Áİ+<²sÁ9ÖŠÏ3k­íØ¼6“_âl?Ÿ1ÙFZù9'êVzµÖl%”¤¸-¡°5ŞO´«kbúÍyea,ŸĞ[jÚ½“V7--	«©DN²_»fÑR:{m@V“U:9İçÿ+Wíšö%¤ûûb|rK7îºÙùt‘ä›¸åÁ¼L[Ÿ†¤Ä+%¹iâGØ%hôa¢ï i¢{G€Ñ#¶8<¦ä{c…Èj0{i—äG´+³Ûµ6zE¦Gs’bò‚©¦ºå( óÎY¸ds\rğp,‹bKyã-á®¡™4R7ü¢³„#Ã´ãPÔiK.–]Yš‡ ªFQªA×3Ş[úäDTµÂØüdÛømo¡¤3.”K2²#fâV™5îB F àĞÇŞÈñ,ËÔ«]CÒÜK:éæ¿p’^´/Şûí%‘)4Şó·MTKş4ŞÕ³ØEMÑÁºø0«“\$Š\"ßLÔƒsìyB8(›à¤.ô”1\$ë’’¥O[·¶AjOVWë¥Œœ-Ô¼[b›‹Ãu:ÎÁçßWlğàTí¥°MUŸ« ö^BJf'H:wç‚k&NI¥5Ÿ%:,, /ü b\\SC¬¥I¤f¢ìHéÊH@¬\r Êà—j&x(´üãˆ.c\n 9-¶Q\"`Ûd`Ó©\0úCÂä/°´Ã&Ç­ 9ääÓâF0ªZ„¦J22hØOÆèkP(­€È=BèM\n®=G&1ÆjkÃØSÉÑÏh`";
            break;case "it":$f                     = "S4˜Î§#xü%ÌÂ˜(†a9@L&Ó)¸èo¦Á˜Òl2ˆ\rÆóp‚\"u9˜Í1qp(˜aŒšb†ã™¦I!6˜NsYÌf7ÈXj\0”æB–’c‘éŠH 2ÍNgC,¶Z0Œ†cA¨Øn8‚ÇS|\\oˆ™Í&ã€NŒ&(Ü‚ZM7™\r1ã„Išb2“M¾¢s:Û\$Æ“9†ZY7Dƒ	ÚC#\"'j	¢ ‹ˆ§!†© 4NzØS¶¯ÛfÊ  1É–³®Ï+k3ëö3	\r¬ç‚ÕJ´R[iÒ\n\"›&V»ñ3½NwâqÖ)4ÜA£gÎà²íUPBêxæS|SÑ³ö™g:üXäìªˆ³Ö('C˜î´Æ1'OX‚:À-Úú=&ÃsÖ&\rëRJ80IÌ-B³TŞºCĞô˜4­ÜC­£LL˜*c” : kòğ½/‰ƒ8©ÆËÊö‰5‹ Ø6;‹ ìŒ#oÒ*³£ @1* &ÉòŠ¢ş\$¢H¿ÌL´70¢Î3C+/½b¾¬ëÜ8¯X9/K`½%(ª5:ÃjW±#;Õ´\nŠÌ Í\0T»!È*jR0ÈsëHˆÀ¦(‰€TĞ­cÊ™¬Ã4Â»m¬{HJçQ¼~¾¡ƒÔıˆs,aY?MpÕPc\nÛ:Â‰#hà´.N€çcVMj2¦”…\"Nğ]XãË0ªü69ÀS É\"	Ş3Î”,–ˆ¬ *\rèÄ<<¹l@Æ1°ã0ê\rËŒ4•à0±«XAJ“ğİ¡@æ¥·`ÖŠ„¦)ÊrJÙ:T¨\\\nC*ÖÎ&#Y\r43ì°‹’¡r£¤hñ·\n}åz'czZ)°ğªCGŒ€Ã~8B,‰Iªb‘HÙµZ*ƒ“3Àó¢ <LÊ2caâ`4L£0z\rpàáxï³…ÃÉƒ0ArĞ3…è®â<@)ªH„M`äÏšø¾1HƒpÖÖ(àTà^0‡Ê+Vû\rËAw8~:30í!%¥¢fwœ¤ƒJ}#³;®húVÓ*¶Vë\nôI72¸ú±1BêĞÈ®í0€(!˜¹4áBŒ¦6_B1()mŸ=Â‘n,cJ5† ƒ†ªÜ\"z®6(0Hë*´uô—pñÊJ<²)Œœ‘ó¬œ:5-\\Ë8PÈêA\0Ame­ò¿† ×ÉÇ5©§™ç¸Şó¢E.‰<Â£\nOh¦VFM3¢#\rP>ÆD^“+.\r&Ø½3ÜGƒ:5Mµo?úIMùm@€˜=\0Î¸L(6\n„`¨ñ£XË!Ë¿ãêCëm!Æ¤ß•¦`°\n7)0¨\0U\n …@Š¢ø &XÌ[Ï©!‹d‘;(ÓÃ‘e§<*•K”\nƒDñ 8%ó\n(fh+qìÔâ¤ƒj \rêi1†•èiÏ\nk<S_'Qj *\r†Ô!Ö´\nvR5Œ´£Ä´iP:L³t’—ÑD©M*Ù¤ô%‚¿:\$TÜ™’Í	ª!\"¥Ô#^ò\$˜V0Nü”`tãÄÌŠÎ¼›¼†ã”ÓBBF˜Œ’)5Ê4”-E¡;0ßHT.nì×¢äÒ}CƒK”1•DtNšvšEéuÏ8¸¤—ÈnNÆ\0½¥Z‘Ë\rÔ4Â…6Ş’Ó“Ğe¦í#ĞõP›¢\rÅ¨¾ƒIXxy]e¤ÏúC%©¢=	ŒÁÇæC’£‘­ÉÈ¢‹A9,ÁHÈ›¸²L³¶•æg“	ÄzÂ(r yEÀ@ÿñIÀ¼U£cRšN-'©eOÀëÈÕV«À'„µø•I0-m4Ã0\\WMf­Ô˜V°A[k}b1‡ª‰WBvë	hN0æ%˜É(F\r,VLÁÕ«:Ô©_Š“up¹â¯3Í«\rWN+úÉCÿgŸ]ÓÄüæ w!¤<ˆ—Ù%ÓLË¶É,ŒÂB&k«%ˆ(pä€PW¡Šãëq8+Í¦·><R¡TŸEF(Âw‘€Ît®½S¢¤^ÚÉ0 ½ÎI…UÔE2é'0í¹ 3‘t8‹y\$¬ì¾‡Bû`ŞQ¨•Æ%m*y-3‰,Î¡ra´‘Ú D°UÀÆá[aìHV•|X:ò°¬[KC¢3A”äÀŠ\"ÍEËjœ, nä4páÃâ²o2—Éà¡„Ñ`ê?-W\\~#®†Ïzb@l!•‚œdzåz«WÊZ\\<¢¯‰	\$yVWK¬(´2¶^ÇÊ¾ıÔÙ”“LT?u@Cqš«õÉ;C·‚€Nl¨ÑË8,åXÎ.u®¥P–„jLé@e^S²}™i8 ¥ ƒ1£œ#£ØöˆÒZ+/×b]®í\ngt]r4TÎ¥{t‰ ºr|ÈÄWf¦ƒ!s”FŒ´V¸Ä†ÆdBÎ×»\"t)A%\rªYÑ·1J’iéÃsÕ7zCèšUkáå£PªğÚôõ/’ìÇ#—äE't®dû•hÂÙ„wa0SÙ“ædv²jE÷İ×ï|ßí)ƒËíÃß¦‡yß»Ö-I,Ù›„ÛÂş˜ÒŠ€‘£D&8Ó[dÆ³7pÊJ‹›·ŞÏY»tğOÈĞ¶Â<X/m¢Î¨öd˜Á½z3ØòC¥ç.Q9˜ÍsLHe#- d”:”9JÌe-–WÎá…JXùy-ûéİ%òğ[‡ËO?ùš™ÒØÑHïáRL*¡y‚7{Jì´cãû‡Úõ/ViA ¤Ê£f¤tØ•9ìÈÈyÔ‚^êïà&;9°¦Âí2BKòT`D\\¹ã\0Ó_ûU/äpÁ¯y¡Š‘§`‰9\$É*îRŒYˆ§Ü’zQ}%ıñÁ0º †sƒ`+5İkÆE8í¹9/\nPt¡(sÒ‰F¨h8*¸Ü§PÎKkŒ®Q-f×kC \"SÇ±î½Õl3U¥Y'e*œ½Ò¦:‘1QeÉ|¿{Ô~QƒÏğ©‘€L¢Z@„4/Ï<&Cª\ræÔ8]œÁÈ<U@®c#:õi&sÄ‚wb\$byv,bÊüp0üå‚Â”DÃÔc0GƒN7&«p2Hp]§Xélªu¬\n\$V2r.† ‚vOÀôÄ†nWbüÛl6íîM\$Ö&\nª)°H=bğÃ©\0¤i—\"Ì	Œ–P|^„7`@:Bè<6PP¬u‚\"E°IÄD î™B;ÈĞ…PŒ`‚-„JiÜ\"Â è6Æn\np@Y)6\ré:`I2²	t“ñYÈ ™pÌq\r‰˜D¬H›0äX	˜LrSE\n‰n4G‡ :BÌ	\0@š	 t\n`¦";
            break;case "ja":$f                     = "åW'İ\nc—ƒ/ É˜2-Ş¼O‚„¢á™˜@çS¤N4UÆ‚PÇÔ‘Å\\}%QGqÈB\r[^G0e<	ƒ&ãé0S™8€r©&±Øü…#AÉPKY}t œÈQº\$‚›Iƒ+ÜªÔÃ•8¨ƒB0¤é<†Ìh5\rÇSRº9P¨:¢aKI ĞT\n\n>ŠœYgn4\nê·T:Shiê1zR‚ xL&ˆ±Îg`¢É¼ê 4NÆQ¸Ş 8'cI°Êg2œÄMyÔàd05‡CA§tt0˜¶ÂàS‘~­¦9¼ş†¦s­“=”Ğ(§ª4›Œı>…rt/×®TR‚ò‰E:S*LÒ¡\0èU'¹«Õû(T'¤©`­’éé.RœÄËsÄ<r‘*8U#åÊ8D*„‚®ÄeR6Aü(A¤\$	œ¤ñªëù_£ˆa˜EÉÎTÇIBı#êdf\n¡MÇ) Fª„Œ*ëùDÅ‘t`AÆQ¡rª%ä`«–ié`\\;‡94B É*\\Ëj:9.£‘l§¥9tr8I£…,\\I(\$IÌM–‹ìœÀ«	]>Ïô	ÒP§96W ÅqÈ^“‡1 „£ A *ğÁÒ@—1ı\$±Ds@@S\$CHĞÁÌR‡9hQ9¥Ùvs„|>^ÉÔñ2FÑl¤ [VD\"{Áğ\"t’¥ºJ¯\$Y+I“€PŒ:ƒcvä¶Á\0æ1Œ#s¼(‰ˆùfÓZeUÎJÃÕ)ƒWNsÊéM²”cBÄøROÔ?~¥ñùOQ–A`©ô½olã9Î©éPT¾R¸µì>°RlkcÈâıƒPŠQ%jRØÑ7F’œ«\nÕUDı\rƒ äÒ4Á\0Â95ƒxÌ3\rÊæ#’ÌÒ”RL\nƒ{^6Ü#È@:Ã˜ê1ŒmÈæ3[\0Ø7Œïæ7c–¬0ŒãÂmôÈ@6¼#«„aK˜riÌV”h1T!ŠbÅÒis±§)\r`œ î½èƒz\rci3BPéĞÂ>]¥HıœA¨w=ŸøÌ!H+ÎËXÚG±!\$1Í60š0näØxƒ˜î7TĞÊ<N€2Á\0x0µ\0Ì„C@è:Ğ^ÿ(\\0Œ› Ü2Aw˜3…ã(İø²4ÿ˜EmMÀè÷ùÊ\\!¬à’C¶\r¯È:À^AñP7P,âõ4o˜a\rf°4‡C`û£ë\rÁÑ¤'H ÉX‚tî¤“á{°\$®Uİ¹qæD	x\$ôEŠÊ/¨æ\$A«ÁgL9‰,Äğ(€ ¤G4=‡ñ!ˆŠCÄAQ!äÎ#º7J‰œü(%iØ¹gƒ|oÎÁ;DÒRé\0Cœ_\n‘Ê#Å|VˆÂ¨Ÿ„Gğ‚p,3'äI‡@¶4œĞÃA>cQSkørŠ\" “\$4wú¼Èc@PI\"Áå†@Ò¦toÊœStĞˆu70x3 ŞA\0A}-ãœGäc•fîW<ƒps€O\naQ|¦ôaÊ	5\$Ü@Á#ŒIvl½}²š …Ñ&¢ÂNC©8Có\".	Ğ*lrœQşiÃbÅ&İü9slğÓ®\0ÜÕàHo}ø ÒÁ\0S\\€€3SXmÀF\nAŸå4`CÌƒĞv†Kiq*Ã‘«}¥äR	aÒ Ù\r.¢SªÕ‚9EÒº	á8P T *™‚\0ˆB`E§Eå¤d‘Ä¨@i¼¢¥T³Vyõ\"¸î„@Êƒ\nØƒÁØ0†Éd‡×:\$]M=ˆÃÜßQÍ¬ù\nB‚%«Tkp\"³>Ì—âQ™Ëí7¯Ôø|+kº,…ˆˆÌÖc_±&Sê…Q»©ñ'gÔ;A‚Àt\ni8™«²/±-•©FZU	jYtˆÕ¾qL)é\$†ÔEaÌ!QYQS‰½º„ÖCÄÕ²r ‚&…£¢Bˆ‚ö	%„Ñn\n‰TDdxAŠÇK\n“Í+¥¢@DRúb ™A\$;Á¤=På¸pn×x)†SlÎd=çÄù•Dğ ÓÒ3»9”ÔD\n¬…?Zâı) Hú¼¯¨})£AeĞÅÿ¤”š”ö\"Uf*ˆ‘û|œFX\\˜¨jÊÄˆâJ`Ë¤A“w†Qçd%äC‹£Ø&ËÈ½¿\"ñ]& SZ)Ê°º)¹3’D\$Ì±K¡öDX0ª?PÄ\$\n’`D”Ğ/BwL“š{ ‚X'u#Ìkr3sÍ€»˜i`È1Ëyj‘õæ «\$¬1r\$øĞYò¡Èùe7§Â›h9«?å`™F(ä¶áÌªHŒRTa%bĞ¤ä¡ \n)W†j@A˜Å¥ëÎƒœBCáf™Cèù‡!¬•›á~…€(+†PÄRv®ÑÚjâé‚¬šŠÄ”ÖL|dì”¡Å\0´U¥drˆ*+U¦X{©/È¨â¼Qb‚jÂØDQ.ÈŞm0ÄìVª”bÓ•şö<Ï—÷‚Qğµ@Y<½#ˆsQ{ëyc,f7ı„¾f\0ÁIK\0|øNiáb\r”æEÄtâ«û\"!­ïÀ2ƒ\$•bbtAl¨C”@LB“‹ô‚tÄqÔ¤`GÜ\rĞ¶Î/›0ncÎaZkäœ°ú_Áy WşeãG£C¥S€—‹1gC˜¶^R9µv»Ù¶GÃ·¯K¯V*/Ëü‘Ç(‰&òQ€i ¬.?ìŒÏ¯ÙÕ*¥û\\³]–¾ñeŞ{—]ï–'YìŠ9Dˆ¼¸´°•DÌÃ±Ç&O\$ƒ:®á\$3]í+ğªßIéNZáûÛ@ï?ƒXfZ`_Îñ/Oèsïï\"X‘È0)Àú~F(u” JĞ0‚c½tTM#hIQ”@¥ºédlK’`¢™ziƒ ÆxÄ9Š`Î‰^,Ñ\n|¢>a>rÎßDÅÊ\nßƒ²!»%&Ô¨›í„Švw¾ø£N’õJäöO/Dì/Zã\$ï\0bğÎ=\0.+àOn:½k\0ìÔõnÿÃöîğ1/=eä¤ä.¡jAÈC(Á^ÁÊcô e¡ÊÃeì:/IÏ\"ÅNì³ìlòÔóoí\"9¬‡…TTÊ”¿Ğ@´htäh¶ªæPğT¥Nå\rhÆLîu\nb9\n°&RËFNˆ¿ÊœÅ-\0°+Î%\rL6õO9\rĞŒ4Ãğ¬Ï\0ÂÕÁPáÅ%	DEJ'‚®Ç„.È\$ŞÉÄôqF‘†fP“€	ˆ\r\0Ê½PŒpzbÆ0.<RAvøÑHc+üá,Üi@¦å«D³ˆ~å†ğO\"ıLôÔ&+¨á*Õ1w°TÏ%üQ-ı@†g@Øi‚\r Æ\r`@*«Š¼8f¦‚ÀÒÆ¬ƒ£˜Ên`êxª\nƒ‰ş\n ¨ÀZ\0@~@ÇCÄ92 ¥ücac¦\rp=\rádëèá¡\$±fnù	êıŒğ	±Å–Cœ1ÁÎİÃ&¹P†dA%\"ã\"2bÍÂ¨D\\z'ñx1À˜ IL<@%j\r§˜5ƒ€9ò­´¡ Á<Z¯å í‚FtkÀ8O Î(\"0aÊZRäR‚\\Â8‚ÿ*Tí0\r‚\"\n…¸7#P5CX@Ê—àŞ\0èÑºz†şFãCöğ ÿ®Æë±Vñ\$)Òä¬T¶¤Øğ\$^ê‚êVkõ0Bìœ)¦3B©@xgŒ\r*º»‘>\0¬\r Êà\nÀÂ`ê Û\$á\0SèìŠàB\r'†\\Ç(hRã¦Pèêj\0å(ƒ‚»Ä OL—0\nğï¥A)rš¿aO)…¤¬¦Éà†hjƒ322Öi2òÚAb#ëjÿ«´àÄª‘\nB\rÑ u4Àt#\$";
            break;case "ko":$f                     = "ìE©©dHÚ•L@¥’ØŠZºÑh‡Rå?	EÃ30Ø´D¨Äc±:¼“!#Ét+­Bœu¤Ódª‚<ˆLJĞĞøŒN\$¤H¤’iBvrìZÌˆ2Xê\\,S™\n…%“É–‘å\nÑØVAá*zc±*ŠD‘ú°0Œ†cA¨Øn8È¡´R`ìM¤iëóµXZ:×	JÔêÓ>€Ğ]¨åÃ±N‘¿ —µô,Š	v%çqU°Y7Dƒ	ØÊ 7Ä‘¤ìi6LæS˜€é²:œ†¦¼èh4ïN†æ‚ìP +ê[ÿG§bu,æİ”#±õ¦“qŸ«ÒO){¡şM%K¤#Ëd£©`€Ì«z	Ëú[*KŒÉXvEJşDjù ¿‘hY`BGYXÊ“ÄƒC\0eQR—«ù:¯ğ‚ X,H10JÂ\$i`­¤!`u¡ªÒRDÄª„\"`YBaÀ°R´u”ĞÖ\\‡[ïi0\\E1\\?ÅñŒ?Â)yÔ[²¤ì v	ÔZÀev…â\\™ÍrÜ»(qTYSP–‰fZDoif@!…êDÃÈl\\ı@TVÃ%KÚS‘‰‰I£##ÚX1’™/…ÚAÃ¨9Pv'û.ƒÀÈc¤A‘0‰TT&%ªJeX¿’ïÑş?k5	B±.¯(Á¡.À(‚B0ê6\ró˜Ü„˜Æ0Ï¢&=¥RZP+ü*u‘äÉØS¯³ñ¼îœ£9Ê¨t®EF‡\\ÿ@¯÷¡ÚA‡YNDP÷Äg}ß·ûæú¾ó¬ÈvO©lF ïåÔèñ1Iª0‰ÄÏg^7J0ÌCJQô‰'ŒO3Œ¤ZJ‘…ä¯^‹ı;OÃ£`è94íH@0MxŞ3ÃcÈ2¨3l¸³;¤Ù\nƒ{d6ÛÈ@:Ã˜ê1Œmàæ3Yá\0Ø7Œï æ7Ã–¤0ŒãÈma-,6¼ƒ«ŠaKÂC%ÙÖH&b¦)È1\rO%€\\ö (TüÄãgaF”oÔ0(Ê£’ºN—²¤*sR%Ã½ĞkÛ-hòòÄ€rDç( ‰£æâMŸd9ãxåK£Àà4ç£'-^z3¡Ğ:ƒ€t…ã¿¤#&à7£]İáxÊ7{ÃÃ‹ª#ÀZC“v:y\"û›l\ra|\$£ƒr6ûã xŒ!ò¦o_ÁÇ\rêXß‚ Íxi†Íìµ°ƒ¡Ït„‰ÒT’\0©unD…:òD&Q±éXÅD¾\nS@hŒyk2 ((€ A¡Ó\0 ª•ÔG„ ¤‚äL7²€ğX²–xRiŠü=Mé¾:w.›Õ™&'+ª±<RGYK&‰\$™xz)Eá\$d^8†i@ã®0Òú‘rl\\ „’:YĞd\r*XØÀ°æ÷à!È7¬ô8‡SyÃ0r\rá´¬Ğİ©Ç{à€1µøşo¤¶7e(ğ¦jrJhº±ZÅa[¢^šS#(YZT)¥>FÑØ)êBÅˆ\"rU!Ä:ÚFèz)£‹­ƒÆ Õ-pÜÔß°oz¬ì ÒÁ\0S[`€3ƒ^mŞ(F\n½l)`Òı]ÔSrEHÈşsÚ/âd\\±lS\"³VªÜ'„à@B€D!P\"€©ú E	‚+‚¶Ò)U<±X†LêNE­3)„Š eÁ…gÀ°ìCd†/âôJ±R&j›/çÑuñ Kû™0eù^ÏEÅ¢bl”L±2äd½ä®r¬©xTeæ¿e°‚?B€NFh\nêd£^5¨Fr§•™QÒ›0\n³Q*İOdªI	D’KÜâ3[¨lP¡Õìt•(ì¦ê|şL`wE**’ÂñÛaTrÉ¸§ÿYSZÆ;PìTO¥l Ù‹<!¤=PäXpnVx)†SrÎ(d?'í='Æ2ÈT(”¡ÔØD’d¾—“ˆ±®UİbJÌTúˆééD(!Ù='´ø_‘²¯SFLg¬È—iæèG¦Áéª`LI‘GˆV­Ç`¶&€êQ¤n„E¨¢-d¡ô`@©•gJˆ	\n”ZÙ:”‚ı5Lˆ¤Åª~mÀ€‚*A–eû¿´^[\"j´h…Q«àòRÀTN'¸LçàâAÉ²¤(ñ¾2J0­EÌ'4xlÓ`<.aÃØ@KF|Y\nÖVA2sÎ¹Ã™W(ŒZ‹İ+^PÉ9+%¤¼˜ âÊŞ\"\\>48Ú¥A\$vwOŠ9&xåfpÊ¡ÆW Ù\"0Ø¢FV\n,Æeı‹ÆÈ+ÔJ*RÜHÄLÙ€Y).¹«ƒôí]TUÊÀI“c&eL¹zQˆk£ê§Uq­Wrª-Fásín„ZÒ8K›İ)£&*>3bxBá¬«f-ªGïSF“\$¡/q‹Âöóé¼o¤õ‰ÖSĞ),§¤µ}™d”A‰sˆS¬\$bàû	\"¯zÑ[Ùâ/h˜RI´c#×ºˆìÔ==Dmº^˜ÇZİ[‡6ı¹®Tj‡C:8‡ÁJ14FùTT¬Ì*éÕuSsšmëZwÅÿØšÍL¡|eD¾TÕË¾­Tíñ¹†¾á;†VŒ÷\"÷Ö¼+toş.½/Ã(fT\\ÙQ×zoZÄ%I8ÊŞ-û+ğ©Ÿ×œkskmOqç¬÷ ×.[UK§ËÜ¯8¹<ï|î^€sîG:`œA“C®'§1Á^ÌU%óÚRëĞ%k¦.EÌIâ¶ÿF¨İ ÍDªÕÕÌvç²<.è¸Ÿ%Çmî\rÅ„Ï]¨iR°Â¼X9^½£µn…Ò—æ¨Ö6ËrîÛÂÂÂöµÈ¾6ônmÂü’#Æ:;Vy~:ü×•â,Ÿ_õ\n–-Ê–½¿,gÎoÏ=¿¹§GB>§qÏaq}ŸM¿NLOØ(‰k¢ökôYwD ± ÂncÓz/Uìä*S“ı·ã~¯)úv¼Jª2qül:8aE}ÜEöÓÏâë¾Óê\n`&IÍæj…Mİiyæùô¼öWVé*ö/^…oø)ïü¹¯ ÿoêÿ¯Ræ‚E0õ/Øõ„>Äz½Ád¾¾Gëê¾ïZW4H\$*ü‹éäõND	d\r\0ÊµO²½†b*M‰î4%nFŠÁØåF·ÌªÜMjâÜhÚ>Älª‚<øNR! !.ÖæŠajµ‚>¢¦µPˆ?pø!R¬bÒâ\0ÓOl…`†fàØi*\r Æ\r`@|É¨¤êR8Æ€`ÒÆ¤B‚É¼€Àêviª)\n ¨ÀZ\0@{àÇCÊ(.b¶©Šba@b«1LØ-RÔ&f¬\"j‹Ã`	°å„ê…\0d Ğã,3ü»Âœ Ã)âDÈ*D\"_èˆ_ÅZ	‰¤CÊÇqr€Çt5ã†9mV%ŒA`Œ×E2%Fnj…®8¯ö×&FÑ¡0Â%8¶Öp ƒ1¦Ô-öÒÂr ¨Zcx5cZ5àÄ©&\rààŒz³§„_\"¹eÿŒƒÚõ*–ET¯EZ4-HÎöEÈFY\rÒÜ*äİå’ä…dÇGbv€Ò¥9`@\nÀÒ î@¬ Æ ê\r¢ş)# »Á2ñlùB†\$¼OAjNÆ˜Qœ8‹<'èØê’à0%í¶1%ÊŞN½&H0³æ{'\r'k#èo#Ä<%	†TÃ¤˜ldAÄzA tÁB>\0";
            break;case "lt":$f                     = "T4šÎFHü%ÌÂ˜(œe8NÇ“Y¼@ÄWšÌ¦Ã¡¤@f‚\râàQ4Âk9šM¦aÔçÅŒ‡“!¦^-	Nd)!Ba—›Œ¦S9êlt:›ÍF €0Œ†cA¨Øn8‚©Ui0‚ç#IœÒn–P!ÌD¼@l2›‘³Kg\$)L†=&:\nb+ uÃÍül·F0j´²o:ˆ\r#(€İ8YÆ›œË/:E§İÌ@t4M´æÂHI®Ì'S9¾ÿ°Pì¶›hñ¤å§b&NqÑÊõ|‰J˜ˆPQO’n3‚·­¯}Wâğ±ãY¤éË,—#H(—,1XIÛ3&óšk‚W¬R!„èauÍO„4¨2¥º)¹lZƒ°Ê5¯ºÎ›B8Ê7°jÈ¥¹ª8Ê•¹£(å,ˆh¬0MB¥ÀoØàû˜¥ğŞš¡¢\"“\nË°@ôK`(D#HÔ:ºø  4#²\\3)´} ,ÉZ Öâ‘šã\nQ{¶†J#¬¦b•c“À¼¯këxÈ ô2Ln<Ìâ.’6à¡ÍœPì@ÈhJ2Fè\$ÏsêÊ‚PãÒï.ÀT¡)/â4€5Œqğß'Œî0Î0Ò0À’2«ˆªşÍc¨ä\nHÒ¿<©\\Z¶\rIR,:M#“à	‰S¼µ?ğ\n,Î,ÑÊ€rpG\rƒcVÖ²£˜Æ0Îh¢&¬Z5¿irÂ ­@\$Ã€Sì4¯c“¶.­Ëfê¼³\"ùT¬(¸ÆÑÄè%×î=e\rÛÀ)ËÕ‰~_ÎdeyÆ¥œû’é~	GƒK6ÎÒHh’6©F3­X\0×#ÓŠæ6N—”izŒ8eÅ(¬ò›ÊTl{#2£xÌ3\r‹8Ê’J	L ¼¢ Ş‹%cpóhÕÆ1³ã˜Ì:ØÉÍ¦…=Ì9;ò7'3àÚ³Û#(P9…)\"¹ÉN‚€b˜¤#4ãz4´ap@!Y‰›ºÓ%+µô¬cm'xÊÃsUr„„Jå¤‚TÀ—¾Ú˜¶4Ãr’†C\\6óè\\=/©IVßCŒëbS½b<°İ¿²·K-;\$i,‰I\n\0æ;¬sàÊ<\ròõ½ÀĞãÁèD4ƒ àáxïé…ÃÉ±¨C\\±Œázãïš4ãp^5c“<:yBû[f\ra}‹…Àã|œ¥ğ«P‹Û¨ %dhü‡D‡šIq„)™ô|ˆ‰û !å'uDGƒ`8„a¡†tÚŒAø~®`4¾BÖ[OÁB#Æl¸«²¸î`‘\r¨Ø(€ ’@—#®)‚tÚHr\r_%œ³\$„{UsˆaåÏ…c|a\$ä¤•’Ò^\\\"-,Í…6¨¢6;¨\0›:Ç¬¹‰Ş2¤è×°òdŠä2ÆØ†øj\rQÆ!ÔÏÀ`Ì  /]ŸóP\\A\0c\$AÌÊÇ‚^DLñ\$\nà½›@@xS\n‘)•—p@ÀP¾&™•/FÃYkÈô»’jM]|jq¯”3TÀ@ÔË‡sGûAC–ÿtpYm€Ñ’'¬×¹e“ë<™Ã*fÏÀF\nİ¾Ÿ–0Æ )¶:¡ô<kÊácAäâ’t ˆyjî™'‡BĞUih.GH®3	ä¸B™H\r‘Ò;”Ó,'b;D…ÿH	ıÜRÂ E‹ÅzC‰q÷Q„@ÊH¤M\$´2f}È\rb)²Ã¼x\$š²#plW¦ˆcš;CÄhäZ†ÃÊÍHep–s\r›j—“’™…–ÂHÁäíEa®ä´*bä¤ä‘@7ÌÅ*8–XDÉÍ`(”NğÕ/å+	¨µeö Ñ°s@¡†Ğ—O¨ iAg”!92âXIÒhCÍ0ƒ§ùÍü5†ğ’†éTN‘ÜGrç	ÆGÿTîNÔøò„ÉÔƒÖLIÍ†¡õGB\r•—\0Æ\\Ã%§Œôò\0¤FSYj³IÊœÙõ?‚Üˆ\0Ù.ÔÜ¼=»%¸Q@K!Ú  ıÕÜ›Ï-#„‡æp9T@Ò™à<E•;¹.›03ÉˆWĞ#†ÌÙ–)2\0½ÏAB‚—Ñ\rÎûªÊÔ\$·Rf\0W3»E\\LL«L®&„H‰ŠQà	pH½­¦µC™J£ª”åb«`¡(\n<a•	…ÎÎQ!W›3dv/ñ3>ñ˜vßˆÈ.8_-LL~Æ)0¥2K’uòq1†\r8Ëce­Š¦*Ç‰ËÆÃ‡Já„å»¡Dl´±®ÊJ,dlOrN;ÆYs’ç˜^*ªs.å¦š2Q\$\nÙ„¿«VÇ¤\0w¾DÄìJ‘.ÏV>3ˆØŒgí\0Û×Lƒ÷ºn¢M ®mvR2o@ßk³¡\$qÑYŠˆñŸY.D–u§ .7 “yĞ¹a7msÜõà¨.!O7PPÏm®°ôÇØ¹Ïì\nÛ^UÑvÍ“–Çsjë\$Ù–qÜäÜV­,Ü9!•okí8s°§ı˜-JÄ€³Ûœ¯ÃY\\\r®©Üº;ÕDáÊ­İg0)ĞäpÒÜ%‡¼ß7÷®ıqF`‰PŠ^HêuGH7\\+{µqşCáœ9W†šm¢ùt%à¡^`S@·\r	-U\"¢/a/SæÑAY…rkÈv¿\$¬\\»d°\"™ÊØEWÙÄGksvDÉ*3e©Ó9æ•Ï}ËÔ·Ç¿b¼Ÿ†+oØ˜Ë¤_”ÃÒún<È4ğsÎ#Õ\$øéY#£tî·L:”¼œ†q8¢_v\"‰ÚÈ v¾Ûg3oëİN÷w~ßŞXvÜî·ãÓ^~d2Àµ†ª/O¾5‹\"7ƒDym:gõSk\$væN4*—8Èl(3ÈA&ìÃ©í)pVàÛÍoëLô €¢h¼o;±ãï	M\\x¢Ï³™5œ [Zè–JHÀíºs¼¶¾Øì.{SQ{Ø]ÏEüÏ¥¶öWƒçø4ÛØs\rş5]Ë\rZÍH§ãØróbşƒ»à~ËŸÖÉŸ4ŒĞ?­åGZ-†uÂ<âü,’‹D]#¨=ÎªìoÈ§®è’NÂé.®í-¯p&æ¦@\$…ğ(í4Qå2ÁEòfHŒ¬Ğ\$LMèÛ:uğ?í”ë°\"êĞLB0L‹Jâ®.»kÆıO¨ğpp»¯œÇğx,rşlsğ6pkÄCÏìûc‰	+ÈVƒø-Pıë\\Àãl)M£Æú°¬DâdÀ0Œå°±†@sëŒ\r(ş/Ëíî”«FØfK\"§„¼/å30H6B‚[\"®êÃğ¬éÈsD¢6fdÌdù#>FÑ	¯yBDsCÜP'dT\r.	ĞùÄ„ıh¢ìğşÉ\"éìBë©Œ^O ¦Hd¢\r€V‘@Ò`ÖÊ™\n6ˆpÂjÆ–;Âz™È¢\$nv&À\n ¨ÀZh[¤^ˆ‚IÂ^ĞªV)Œ9)ÉJk í°Úâ#’Bƒğ>Åd­²á`›±xT€ò+‹¼8ÄÊU,bØ/fÆ8«~LãŒá!Bİa2õÚvğL£’pËÔ,d^rv%ÄTB\ndk’! ˜\rê:2&˜ç8Åâ¾ TŞ8Àô£+ë\"QÎ©`Ä ì…ÍzZMz§Ê ÛhİˆÀ¥B9%í¼İ‡4\"§‚Gğ®sòn©püÒ^\nƒX.^2di\räVVË>ˆeúC’~%ã®û«b<¥6S¤Î¬\$lø-¾£¤F,…¨BdFÎ:bÎ·…v¡Ä 	‚rR%èX400L„vÂæ,Š{)à@‰ÀÊğª`ê Ú@Ÿ)¦Ç\$#Ü\"Ğg³o9k¢¾¢l\\à©%ˆvHJf¥b<•Fş¬X¬je&‚ş	r˜IcÜcŒ>Ã*%rö, /J]00d)j?ª ½ƒ\n2(b£Í\":–";
            break;case "nl":$f                     = "W2™N‚¨€ÑŒ¦³)È~\n‹†faÌO7Mæs)°Òj5ˆFS™ĞÂn2†X!ÀØo0™¦áp(ša<M§Sl¨Şe2³tŠI&”Ìç#y¼é+Nb)Ì…5!Qäò“q¦;å9¬Ô`1ÆƒQ°Üp9 &pQ¼äi3šMĞ`(¢É¤fË”ĞY;ÃM`¢¤şÃ@™ß°¹ªÈ\n,›à¦ƒ	ÚXn7ˆs±¦å©4'S’‡,:*R£	Šå5'œt)<_u¼¢ÌÄã”ÈåFÄœ¡†àQO;zºnwf8°A®0œÆñ—æ¡§xÿ\"Tê_oæ#‘ÔÓ‹¿É°™%x á<¸È\\”&#é+\"!/CÒ9%ˆâÀ™¢ËøŞ6 K¸Ê>¬Â9¤ƒÌ2®jâ2OcÜ†C›¶0Ã¢¸Â1 î¦¸°¢†ÚÂğ˜’7%ã;ÀÃ£ÃR(ê\rÈä 6Œ”7*pÂä1¥pC˜Æ¬H¨èöÉƒ¨ê9B²¼;„\0áÃ{jË©<¾9Ì Pœ¯²àÒ•Ã¡*R1)X9\$SªH	jò,#£t™?1ŠpÂÂBÒ~å®®%æ®Òk\" ŒÉxà™ÈªÍ.å?ƒZJ0£:V4÷@0£l–cz)Š\"`@7µ£”WÔƒ«T\rÉä »È+­.½¹•£¦ŞÂ±¤12Ó<Ò)Åã¸ò\rCÒğÈÚ8Úî[te’1F¨­£mBË(€P’6ŠÈˆ£ÅÚ9RSf[¬‹]C\0P×B\r’›0ÍK°Ef3R«ĞÊšŠ³|sÊ¶7(\$:ŒcH9ŒÃ¨ÙP#kĞæëJx¨Â3ÀÊ*ôª%#jõ]¡@æ·\n:2/\0†)ŠB2|å…ÁÅ’³ƒ c2ì£Èmf8+£,Û†aÈÛÀ5\ràÎ2a’ä14+ÊŠ¦âRË @¿é¬öŸ¨Íª‹–aìºo8öt^â¿”2ë\0xî\r@Ì„Qhè8Ax^;ñrc—/c\\»ázgË\n æ4¬AxDÚHàéÂí²N5„AõÖ—C‰˜èã|ª*pƒb7¥5İò¨ tŞ'×&¢7?bIú‰¬±[ôÏ!©M¬50Ëû„2ó0b¼É8Jp€(o<×ˆ‘Õ­×p;!\0Pªæˆ¾m\"Zùó›Hãšj›§)Ú{ >Nnp‰=áÑ ´0ĞSC;´&¡\$Š–Î\náN\"ª`•\"¦‚ˆu(à€3ÂzC#iÆÄá2^²Í‰³Käpš…\0Â -_gpÙ•–S`#B1EÉ•“\"c‹á\r\$¦°wü 9:ä°ª‚\0ÆXƒ1xJå¯S2AUqE5„¼˜¥ÒDÎU‚²Š%Èá†“¸‚£à+eEv)y ôGš„bìKÁE!ˆhDó		À€*…\0ˆB E@€\"P˜dJ|\rä¼6¢t:Ê( D6KÀò¥Ïù3THLÜŸ¤ö(f,x‡e€PCAè@7c²–d™à‡Æ¨ïôvÃlI:!µ­%“ÆyWyÌ#iøÃ5À†	ªßF­c†£Œ×’üU„us¯TÔ›I×Fs=	…˜ÆÚ‰dìÆc¶	3E\"Ñ4â9°Ê£!yğ=GÅ°A\$é	›¥ĞØçÁU˜Çjpeå1ŒLgÌæ0ÒB¥ŠÁ\$²V‘ZÔ<Ç…-Ñ#\$¤¢ê,aàÈ£reK\n*^L¦ÀˆOËíY´ÌæGhãĞedÄ|¤òîˆi\n•tQ@PP!®şZ·ôbØht1ébŸ-²‡Tg;|Jéì\"™éjE–J!=§½§TğÂ£#²ºmÀ‚ĞòD	H/àÊôîJL©‘\n0h91SÜ?8§Y<W­«|6»Dßb^mŒ°}ìÓ¨à#Ø(ªĞ2+eĞp¬9*%•lË§ŠëaH«…Ø{0qAu®–\r[2I-¥–±õæ€ª³kb\0eÄ¦r,VI,k‹dÀ™Ë R.©-‹—dÙÛbH‹+{7&¡X“Ç\$@@m9ò]‡haÊÑ(¸W æš à°âøjƒ†ju„PÜCûJf±şùJõÕ*@(+•\$ÒO™S\$g%F”áéÍx] ÄÏhp²‰²òÌ5²jz¹ÄÃ6â“&L:pş'¢k1!YûCŠì”L*ú•³¨Ş¾?ºµDìŸ£õRsOÈ‹Ñ7¨I1“%2¼:ˆ§!RÚW1‚Ä\\:Iô&äš}J„•‚”Õ”æÊÊµsVkÍÆ¸H9Ú'á¶lM%—‹êõ ÍÓk,cÓ9Åá9—ÅÌØĞd¬w\nÛ†K5_oÕMÆÖçCèwªŞešBÎÙô©ôx¨\0‚=á‰‘‹5yÔ•>å¨ëõV¥ÏLÃÓPZ~\n(d§¯0†ÙhñdÙE•Å¤ Ø¡ôEËª\\„‘ğÜušq!L½Ròto*´‰o#^¨õ¯uûÓ8ûHÔÒ:kŞi,ˆ·µ júPk½7#¦Ğ²·2iFb—‡|È¥ Ê—1~~ßÉsjy±ÀòÆy´<\"·(ÊÊëÉ%<ka Ãå¯yº´’“^0@ø—	Öœ}f,åáYˆ\rú«EÔß}ğÈ9\$íœ9&jƒxi:ƒDV&\rÅ3o<ÒÌ€êî…Ï‰f³²1Õ@ªnKO:>Šè‰›¨(”yQÌÒ½#@¨ÅÌÑNÑ*ËÆ2¦4îÅªYx©¼söZ@Ö—Kìª¶õDĞyûw]<äé	ñúÔˆû6lâÇ®µ¢NØM|'€íìÛ…x€Êg™H¡JşcÃBÉšÄ¥IL…¨ÄğhùéS5ÚÉyúÃİÊ/£V–„\"E°ÒÆˆm|efª[Ğ§}–²ÃÃÛ¤Ş‡\nŸEã²Å)†ÀVÈñ!ÛFO ˜}˜‰‘\nµG ÅpŒi‰a;Sä¹…P¨h8×=œ\$kcHÿopaŠøÚ½\r¸·V¢ñ+;ûy+âÄ`>\$-ècâ IIºß\0šw\0ÒÊî\\Â„”Â,ÂcïãŞÛb<¿à@P 9G>ú\0ÊúOš8£`%…¨ZÃÀ…¦N@¢â:€è@Cşºv	‹¨x¦†`¶‚ä{c(\$‰YLZ¢Ô»\"‚.i°Ç|şÍ„!¢]O†•T#£\nÙ§ Û…h+ÎĞ¢pŸÍLâ¬XÅä*c8mBF8OV'J.o‡‚\\`Ã°8CJßâ,QO0eMrÍåú¿ÇæBe’T	DTj\\zôH%G ¬2¥Ê³ƒ˜&äšŒÂ<!BRàiØd¬C©J'E*OâTƒ¶\r„5éd–¢˜.Ob	\n’%bú	ƒ <07VÊGÒŞğg„&hp’(b,Ì\0à+Äœ–\$5æ\$5âï±Œ­ş9¥¢ÑBä7Ì°HâT?`	\0t	 š@¦\n`";
            break;case "no":$f                     = "E9‡QÌÒk5™NCğP”\\33AAD³©¸ÜeAá\"a„ætŒÎ˜Òl‰¦\\Úu6ˆ’xéÒA%“ÇØkƒ‘ÈÊl9Æ!B)Ì…)#IÌ¦á–ZiÂ¨q£,¤@\nFC1 Ôl7AGCy´o9Læ“q„Ø\n\$›Œô¹‘„Å?6B¥%#)’Õ\nÌ³hÌZárºŒ&KĞ(‰6˜nW˜úmj4`éqƒ–e>¹ä¶\rKM7'Ğ*\\^ëw6^MÒ’a„Ï>mvò>Œät á4Â	õúç¸İO[¶¬ß½à0´È½Gy›`N-1¬B9{Äé·\0D0Ùù‘¤É:h8ûš„ƒ–B¶0ÔÛ‚9–ÊÁ­,ò¨¬Ìä;0Ä…-£°Ü\nó:9=ï@è»#Ã+rç·«d(!LŠ.7:Cc¶B²~ŞŒHÃª+âñƒ«–\"µ-Xì4Œ£¸5HÄ.Ø-âpòâ1hhÈCÊ@„²\\šqLVÈªZ5\rè»–)Œ#kÌ7ÏHÜ¶ì\nvï\r²ĞÎ¬Ê€:0+Cì\r«bÔÃB˜ÖÅ\rÈH*)Èûd3±€PÉƒdÑ,­‹^¼£˜ÆÉ0\"ˆ˜k,D2\ràP‚:¬“Ò}1Î0à‹HëwÇ(Ä[!Ã5„‚‚cPÊÈBzFË:Cs]Åğ´0 ØUÕx(-1Úòµ°HÚ8NÌ\0Š–Úı{_°n”†¼U\r\nÊ€\rÈú|¦c`Z4'cËp,è ÂçÃ5‹¶àARPcxŞDR:*9£Æ2c˜ÍH£‘=Ò3ò;l0­Œ*‰%Ï#uH2…˜R”Š£8ò6/Ë@!Šbv\róØ@„Ré×PÂÁ£#=tÙB¨éë^U6#ÊÁ¥&05ºU Ø–it\rÔpÎâ:.p88ctœ:%)Z¢9£„\$´Ij¥ªl\0x0„B|3¡Ğ›Ğ^ü\\Åã«ÒĞ3…ê_<\$HÓ.…áê9.c¦ò/ŒHíÖà¼ÕPxŒ!óQ‚0c{ß(ÌÒ8yòvÕ±á²J^ÈiÚ…*:'i²06¸c³ôÕØOÉ%ì*R¸®jeI±Š5è.ƒìÖF^\nAÕŠ@ úor~ µÁBŠ©¨\rÛŸ)k´ªè96Q4:z&­­xädCš\\h¬§’òbdº’Äü: Ò˜Ğ@ry%õ5r–Öšâku¯<ˆ‡•ê@p \rÁ½`”´–B1'ÁÄ:°Ã¤ƒ‘!‘Â¾ã2S&(\$Êš&Ô\\ÊA¤#æ‘q&5FK9X0ÂPHE~&071BğPàÑ:'„ùëÇšëTâ]\$ÁèËñ>j¥;³Y’#„x›’\"H]\"\njh’`ØÛtÁP(´:´Ö«´.ÁºE\"RÊB§<Á7&³(™öQá<'\0ª A\n^ÉĞˆB`E”dL7¢b,RŞÒ^é„Í( ÃË·71MräÒ*eR'H;è[+º^æ\0&V¼»a.CA663ÖHÒÄÕ0„\\÷„eu-Ÿ«'8Ä	\$2JV4æ}`4/t˜£Œ s;İ¢ Ø‹'*µ7P‰#®)Ô†–`oYÈúËÒÒ]¤¸SBèÕ*”Y\0B \n]N¶@–èø_åz°ì¢¡¶ŠÏñ,´N„v¡P;Ê–œ	£Â¡vŠé|4‡¤4Ë(pcè¦_'@‰fÂåGª™Y+•aq1„µk+Râ\$ê\$&šbŞDÎ7³B+¹'%EÃK-áP´Ñú³3É9Ÿ-GÍ?÷r‰áKPEñ„Ê–A‘NIRÅ¬ººÆ9†ô1rÂ0e­1%ÿ0ÆÀO\n	oJ €•{&bƒ\"PIv`À²İÕ fvgH'„¶)eÌX y¨ì9–Èlò’´6ŒZ[OfÌYCµa¦Ö´Ãôc‚Q¾,{fO¥“6È:Z\"yiX.³QÂÏ¯û›m-))	a©ÙŸDòt¡ˆwJ¥%2:GÔ}ä×œ™˜‚Ui±=.ì#¢\nB ˆ\n\ná”1HâkM»nÌœú¨zKd)ÌjğYo	Ô´#ÅNÉŠÉX€*'ògĞĞR·%0¡Ï%»o±T}³\\8+2îñMÄ·Ìé’šb‘¦%vûÅ|H@a1–ÆÕÙb¸ì°1æD–á¶D¾…ÍJ÷D¿\"oÊ„(h ÷årgDRò^ù~3ËtT…áË©JÍâ¼ƒo³]-—(h%ÊÔºúT9Œ ('K>_CuÎd4Ïw´t¤Ñ\nY·5 tèÑ8ÿd­4	CÍîí_µ»94Æt³ør¾¢<WqÍı·I0ÓZË]t«åíÇ\$TMUg\r»··ÒIÚÁXµ™ĞòF¯käÖBr.šV:óbÉMOöGÄîì%Õ0ÊÍcÄ«¹NÔ‚‡¶´L'›PœæÅ«x¯¡ÂÙT-QÃÛ[s;Jø«!·.mN`•\"|h¦†àP´ŸlI“³«È%UYoÔj°†¦mhûw;®DxÙæÊH3×‹ñ’‰G¼{Jí3hm§á„Gu\"Ø\rƒÈ'¡)å®ë`é¾eË´¦Òä<Ê§[\0¶ôñ„çÎèøf3®© H¿(«)Ùs¢ä;.óåëı¥9†(Ô¼×e—¾·ÎVç;VØA-fÆFİ/«É\riÕ€I{,è¿´”ÉÛ0áƒFÁÓ9¨:Êqù~ÃïÕ¬©iNmàë6Ñì<Ç³ÖªÍÜôùñğ‡,*å	Ÿ:AVarc¿a¸ÖBóè,€ó¯¢Ã™™¯}lx’vãaJZR5»ã9”“î¬0Ñ=©åÒeÓ÷l4¡ûàÙğ6¤®IDÊäèC·¿;6£V\n]]ğ~¥ºÕ¶óW€ †|C`+\rj8„oN]2¥Œv§EBRŠfàxÇî\$Ià¨Âì™ÊÕ&‚RúŒV\r)7ì^ºO²Èß\0cìÚˆä¾.e&6\"–ìîò¼ì´9cŠÃÏFöĞ28àZÏ\"0ÃJı…nŠ‰^¡ìĞ’|É0 £˜lğ^:CÌŠ\$\\Dä#\rş˜cÒ0jˆÇ\\ÑiŞĞ£¤{E;\0‡vÇ°%í^›O	d—K‚ÓìˆÍ¬tóĞ¡BĞƒ\$Bf2%ŠvOÆuªfßV¼DÔ¬-Ê#0\"’àš„‚ĞÏè—ƒª@KÒVPjÅ#\0%i4-Êj/ @¨D|¡Bvú êM%}qª ‚-©ªª ¦WBï&Ô9EDĞŠN‰¨šÉ 2MLŸÅkc²Î°¬0\0†'Ğv`v å¦Ä—\r¥=Àæså0\ncD„òÎ&Læ";
            break;case "pl":$f                     = "C=D£)Ìèeb¦Ä)ÜÒe7ÁBQpÌÌ 9‚Šæs‘„İ…›\r&³¨€Äyb âù”Úob¯\$Gs(¸M0šÎg“i„Øn0ˆ!ÆSa®`›b!ä29)ÒV%9¦Å	®Y 4Á¥°I°€0Œ†cA¨Øn8‚X1”b2„£i¦<\n!GjÇC\rÀÙ6\"™'C©¨D7™8kÌä@r2ÑFFÌï6ÆÕ§éŞZÅB’³.Æj4ˆ æ­UöˆiŒ'\nÍÊév7v;=¨ƒSF7&ã®A¥<éØ‰ŞÒvwCù»İN¬ A¹g\rÈ(ªs:èD®\\×<˜¡ç#Ğ(œu6™N\\“ÑºÜD0ß7ÂèÂŒŠŒŠ7¦€P˜¬¸KÀÒ O°#Œ£{â:K°)1/óX1()¾I äï&,ŒÏ\$`Pÿ¥#zñ¨,Sr1\rØØ7Œî0æ4¹nhÂº¹kãX9 £Tz(\rãXÂ˜´HòÜ)Âƒ¨ÖÂ#­jüØKªĞ¡ƒæ†JcÈïË({A+(‘è Lƒ\$2\"c\"LÅ€HK9CƒS…;O£*;­RL–^B0ê7\rm:Ü £ƒ(Î0ÑPøõ)1`PÎ2HzŒ6(o8¦7L#ƒ,ŒBŒqtºŒ:R:Œê:’Õ@L €8cudC½	í…¡íX¡ob%WN‚> ¯’»šÁº#(@)Š\"` ªp@\$Ã ø¸ PŞ:ì«Ø?ÎsÛ2Ës˜ôåÉ±œkvLãœh—?.õÉs.W°Ñ|U¢î—r91¨ªÎ1B »	y@ˆø×?BHÚ8ThŠc•\rõr–odĞ6G°ãıxá+UŒ3å+®\r£Æ‚ èH@7ŒÃ2Dû&Â¸óÇ,3dÑbIZZ:á¥ŠÊŒA‰:#XŒ3šƒY)jæ ÎáêâX\\èã&’«Œºb=„éå£©ÙK¶¯/ZÓY®b©W°ìvÈó³í;^—¦çj–^ï¬îZØß®ïÛåÀ‰°œ‡áˆpÉèœ5¢\0†)ŠB0]iòĞiHÃYŒÕ\0Ú:ƒM¾aÚ‡ÆYI^86¥Ú~‡¦Ñ\0æ5(=\rØZ¶¿¢GQá2…ò{êjPuÒYg¢éLÿa¥~wÄ0õaâ‚420z\r è8Ax^;ÿpÂòÊ€3‚ğàxe7#·&Á­Aœ2‡GæÃ¹Q\0ˆ ÒÆÕ*àT@ğ†|Ps\rÃB¶(*bWPjåôÂøC•™%…ƒ\$±öÚ¾#Å‚fv‚°‡‰Ô‡p@@P3èÇ†ğôÃÑò‹+,QvÿÏ±sŠ±^,¬dÏƒ%äÄ™—eNÛƒ%0°ş°õ¤×reP±–4àPTKl làÑó´&NãÛsa•Î†—>J‰¢ñZMÑª•5ŒÃo?¯e±’v©!\\-\$Gô1/\0àeKø PàL“¢äT	°J!ğ×È'BÉƒÑ%\$ …²0…™.A\0 ³äôğm\rd|Ö-¤’®¤´Yzx•‡¢NÁ[Q1%n!Õ¥’·\":F%9ï”§Ôƒ«QR²W4´¥ 8˜4£’;Tñ–iëJå¥É©Z1±	i8¹ve( „B|Áœ‹%È#HÓD+_ƒì„§7R\\M‚Xl±Ö#†2ÜÈ_:bZ%Ì 1s,F–)ü’Nãpn‚½14Ì2SRØ¡Ş°cBÁ9	äém;µu”fGP˜r (*Sµ\\ •‚»A<8)®î§!HœÈIâ“ğÂ‚Z\"ñs˜ƒ¯ä9Ü7AAcÏƒ:æHõÔğšœe™);ÕØBæüP*™“Œ©ƒ¶ôhfí^EÎCÂS\rOH1\0ô¸ô‡Wƒˆdkğ– HùŞ½¢@ğõbÉ¢\nÆdğIåğÂ®|[``è¾ö	xc…A<Ş@ÉÈo·—'¹ñ6PÉˆ\nI\räËš=K	Ë\n†¹RÏÂˆQ§-[ƒ!¤ş›³ê¤Ó“-Ç~¾İ+p˜Ğª—r³Öš’PÈnˆİ/CB‚ïÙ:7C\\İI‹‚D6)hñVã<©ı¤´à<Ô×sL9‰Áî‡^Š¨…—jH,ó…\"âî-¢…vËæºZæÔ|ÏØfPê\$‚ƒ±¢áøAØ8Ö1&(ŠQxlÈ¡5ğà´ıSl ¼¯6Ü¨\"|1æG(œ¥“Ì°6y :€“®e%­\\Û°ù9“²¡“p™l¾5ì¼äóÃÌD?2NğÓ™Ó–X0Y¯#æÜºrüaÎD%ã†\\êCÈşxÊi½?¹«É!J€Î,©ÖM	›´‘@WVõ9.œ¸M@JHxš_?èŸ§sd•Ô:YãiM§22Ğ4û/˜eVX,™öÚ…5ê\0IÑ¥Zøª§ùC“m\0ØĞìA1î‘U·¡ÎìäENõRFˆJ1kú¦l¡'¦²'Q*wM	(bbeµ]%“E%{¨A³ŠB BÍş¼R’Œ	ƒuñ`<`Öt±2o²ô”±2õ6á9C…Ùa×Ò˜u'Á¦ô¬§…óHd·×§†qs¬ÛÉµÛ/Å’qbƒOìÔã}—Ï•ñX}Ë3¶på7Ó›;&\"¹é(j¢¬Ë¸l˜kvF=ÅBQê…Ôz´·\nÀrCSÙé½YPõ‚İS*5O8FœØUşBjùÀ\$ïˆ)…ÎveUúı *§}…\r>¬ÎPR{º*/esŸ–ó~P3ìÆG×áyöeÑ=Á#ãì¯†[2àös¯+ã»o8ÑßÊUöÉlúïµ>_lÒ0Ğ„®”™¤Ø¿–y|v×¯.¹ÃCæm7š{gÅ¾ÏÜ{^KËıÊô“#¸j}•~²4¿Ğ±“îÊ½ò;=hÚÑ„KoQÃ¶ø~cÄ~ı#ü?a{n/ä½'¤?«	ş_7Ğf	6À˜ĞªµÄn¨Å6ï\"‚vè°´àòVbX€æGå%c„-f®c‚% Ü7Â´!åfÀÚ£F¤ĞTÊ¾â@T:lBØ]èZAZVddZGâ>B Ÿ\r˜şl\$üHàæ‚ˆF0\0jŒLË\nÇFï\$½ã\"¾/ŒåÊl÷Îf\nŒL*ŒòÆæ!	°Ÿ	ªşï:ô¯Nwp®LDzhLn‹füıÂW\n‹6wĞÆÎÚš®à³ÖkĞ¥îg¶¿Í##¤ôÆHdÇCNª“PT ãÎ­\"ZcĞ8ŒU+ZD”<\rÈ0ô©Ç„XÂFÆq Òªo†úd«\nN^áï’Ì\\ú‘A	o'	¯¤ö³®„æpğÆE9C™9 äG°ø´‘dÆ‘u¢åï‰1jéî¸ğ\"=:ÂP¤üÎ ãæ…clıÑPş'}OíÏóåÚÃƒ ÂãÛoPÒ1¤Vãü¶Ñ\$wPÈ½dJ„NbÏíIÆãà«±Ş\$oÊş·¦'Æú*Ñšäãr&Ãd| æõå”ê±Vø£¼s°,BËØLã63²¬êèŒ§‚ÖÆ±ú20š’4…‘Ü\r2<D2@l27Ï¼ƒ6*£\nN,Š<´ö20\r1\"8\r†:Kbô¸ä'ù­`ÏGm€ø ûÀ†B€Ø`Ö*©˜(JÀWhf\$âƒ£ª¤Iÿ%ĞPGbM\"”†Æô…¤¡ ª\n€Œ p&ÒŒ2qò*6c§(rŞ0NÚ˜Räcré!&Ï.íj5/ãË¦\"1DZ#¬{\0Ä#°\\òèÄY£_ƒÄÄÌ.Æ²¯%ñø#Xgêj9Èi°^ ìêÄy)€¿2‚>#Mû	[6BHB„¨0D´GB=H´(NàÃ¤åBˆZP¤ @Şrbòg·8…K/*bÈî+¹8ÏÜ N“9,ï/Ğu9óĞÓ;³¬ä¯Ú„T8q§¶`Eş`“Ä?dºKğLL(‹(Ü…¤×b8F2Œ.F ¦éG¢é…¢Bè¬.§tñÔ6ô‚tc\0®©ÂK@Ô^ÂÜ@éH(/º¥ä²?#ä.ÂDã¨†X¼¾\nT=\rú¼*¹<î6Rc+ã’^\ng:sátğ:«s”‰™&ˆìgCFîƒìCk#AR/Gá6­µ3‘€Ô<B´Zq¨ù>4LLc˜Eq0{*\rª¶e€Ú?‘Ï'L40\"";
            break;case "pt":$f                     = "T2›DŒÊr:OFø(J.™„0Q9†£7ˆj‘ÀŞs9°Õ§c)°@e7&‚2f4˜ÍSIÈŞ.&Ó	¸Ñ6°Ô'ƒI¶2d—ÌfsXÌl@%9§jTÒl 7Eã&Z!Î8†Ìh5\rÇQØÂz4›ÁFó‘¤Îi7M‘ZÔ»	&))„ç8&›Ì†™X\n\$›py­ò1~4× \"‘–ï^Î&ó¨€Ğa’V#'¬¨Ù2œÄHÉÔàd0ÂvfŒÎÏ¯œÎ²ÍÁÈÂâK\$ğSy¸éxáË`†\\[\rOZõƒ?£ÅåŞ2wYné6M”[Æ<“‹7ÏES>,º6Áãà¢&ç¦Ó.ƒ!Œ#\"i	ŒËŠKÂ„º®B8ÊøŒ¯:V1-¢[2„ãp¤\"‚š•)0\nD1\0êç½h\\Rì¥\r82qlC¿b+œ91âjº\r([¤‰Æ°L×ŒkŠó\rÇˆ£¯H	kbóÅã¬1Lbbå%JôÄ±lk•+RÌ·ÈÈ¤ÏAKJ2ò„3œë;¶1¤™'1â0ê¬ºå¬ú º´,ú(&Ã´Ç.ÙH á\0Ø7±ËØ9@Òxlèæƒ9Ã(£Jœ§iê£(HğÚB¬ìPCbLÁMz&Ç\rĞâ©\0¦(‰Œ€İP )Ch1{â¡9ãäÁ¼€PÎïÈ2ìÌ–ÇE(Ë“,¿+t£ä!®³=Ò: 0‹wŞ1ÕÃDoİ4µÈÚîı‰#j<„1â(ñ°N5Ø•¥µã\nPıñr3¬ûhŠ\r8Ñ´©d@7ŒÃ3Ö7©Â\09U2|; Ş '£ÈAAc¨Æƒ\$0ê“Rë»\$6c–d0Œã\nğhóÖSŒ¡@æäÃxÖ”¦)ÚBR¡=j@\\GÉS”—®ƒnv–.-RÜüÔ©ÄM–2èNPö·bšçšon\nŞšÀ£„3Pº\$ñıÅ\rÃ|ÚÄ0Û’:Ãcºé:+ƒ‚jêkáâ43£0z\r è8Ax^;õt” árè3…éGkY¥œœ„Mğä3Â½¿^§£XD`#ƒ_¶à^0‡Ê{dü‰üég§š:#¨:y’9ÉÀ‚Ù2yeÙ@É\"+¹MÍøÃ'³.4(KòÉ;tj:§‘ÛdW¹!|à€(€ DÍ±t0FàÙ‚ \nI9^~¦,9‘àÜ¿	)8=ë9/åneËÀvk¤Ü€¢pÎt\$@¨€ ”2ŠAá`D}î·3‰ñ1h‘¯…á“iÒ‹94DƒÉ¤D0Õ=Ã&¹¼6FuJç\nMˆˆv4™†â\n¥ÑËÕ7¡Á¢2PxS\nˆìÁ\"Òxî‘à é(2P@›Ã u!d¸ß=õ_ƒCT¤%™Ó[‘ÒÖ\rÄÁm¤>Fb3‰K™¼ Şd b.Ëd8PÒ¯› ÁR¬F‘ÈCÛŠçÅ\$\"H‰ÀC4ä‘ÿ¥BzğZÊé÷ĞÂp \n¡@\"¨eüÁ&YEQcu—j\r\"³ò‚,b‰ê€¨Hò¬ÅÈ'‡nùÏàepÌíîàØ¼ÌAåÅZ˜´šsNQ¬bÌ¢d¹+Üš@ °¾©XÉ@˜ˆiÉ7”i^Ø’ã‡†ÂZ ùXœ8\$§°¼ÀÆÜIC,÷eKŞ‰¶rœlˆb(æ’‘D˜‘Ñ¬SÅ½@¬Ú\n\$3'¥1€ˆ9!2å@=\"yÍA}MÜ?ƒ/`9PTåÚ8­bQjAŠI\"˜ğ†Ã`a‘ê°ÂVJ‘U5_`M1?R\0U\rqÄŸ™š¸‘«#«ó¼¼€¡†#b1O©’œ¢E`YÄ¿.¯\0006Î’¼^•„[óÔ˜¨[,B MÜ«  ©bŞ\0r\"Š\"ÊÏ†h+ P{Äõg)bğÎÍb¦àfÊnK’Œ¦f-æ#ÒHsÙıDˆ\rv’Ô_'êê3¡È«—“˜d§bO@¼°§¦*œSÊtºæ€ŠUû Æje!Eî ]dàhfB¨ğ\0›¼Ío~¼P-ÁûµyØ½é½pğŠ¿²U–!«%—…G0’p¤Uğ«¤“ËæàNeÌ½o1’İ›Ÿ‚Œ184<`ø„d1;ˆ„áƒ`óŒªQœ\ráÜŠ<˜rŒiK=¹‚HôuŒJ´4@ÇÖC¸pÉãEÒÚ•R˜¬%nC%¡Ü2†'¤zpîÆôM”ªIïù†(öjæY?R	kzÂ„Ÿ.‘@‚§ÙuZÕM0S÷Ñ{MìX­¶S{+ø(y/µìó\nƒZ<p‘½“ªÊtó³t,˜Á˜P@Q—1¢ÚG*WE¦²â Œ:°€¢Œ†©ùz.†Ä™ÔÜ³½ÃÊËVËÜ‰ªÃLçOºeÀBXsë7RêŠ¿X	í©4……¿“|#«¯ÀTÓ¹À ÁN0S4Íqhîhš;¢ö•††uÆŸœ}¶ii]´Z’i¨q°S5¤ë‚ˆîjLiÉã\n9¸bùe#qyo¾t¿P,›Şíçtw­ãŞ÷ØÎg£doVü0èYÙ©l¥Å£z§lYƒSfø…ÑùóIq^jGp‹Kí‡Æs+æC‰àEçcÜj-}R·\$æQœà\ríôÙ¢şMY™Øö	ÄtA†vW*åç?˜±ş¾	%	68óÓ1cå‡³<‚:q=£k\nøJöArØSi)Êé5Ö˜nŒû¶²\nÑso÷a¥¶şë	„Á›~³ø›toa¿ç½#<\"Î#=ã?Y%ÎØ<-ÄaCÅ,¢E=ò-@–ÑFNû|YñyW¬ã[¨tQ|Q'ÚÙãÓOQp8ß‡ÏŞ¶ŞzŸŞüq%ª	Bs>To®·¾K(:ÇŞ©—§ø{-÷½D†ÑTMèœÚ„­êóõŸ.Ö‡Øì-õ¹&x÷ä·í{Ce;OäúÄä€Îpš0¹.#ÀÑÖö’2q»IòG‚Zöâp	\r\nâ\rî˜@K¼‡Jèy/\\8Äôù*hV'¼ğKÛ/‚\$hÕá`†Rå<ONb6ƒ/l¬1äôUC6áöß°R€-öJ)b<àØ`Æ=e(ïbÔ†ôC:‰Üq\n:lŞ ZRâ¦“èX¨¬0†´˜@¨ÀZZÃâß\$â”æ½Œ,»kò(°º¿‡ä)¢8#Â@ƒL2dş´ÉÒ:²@òÏ*ÂÖB(ÿƒÿNœd`Öû¥¾ \"/Fä%‚p\n„gÄatc\"Š.@˜’ğ®;±\"“ãpï¥Dº%ŠªÏFVàÃ\$°Yg±F1Âjj6QB6@Ì@\"¡ÈTám5ãdããj…¬sG9c|Ğñ]TîŠ<¬‘l4Î·(¼\ràà9åS€ÈÄ…è>QZ9nø0ÈÎ6%\"3#”_#d/1Xì°C,ˆ'IÆÛB)Å\\ù®† ÊxŒƒ¬#\$Ã:ÏäâJCr2‚ô­èî ÊíBQÇø—ñœ«®Î/\$b1ê€.«&Mğ†8Ë>Pot £ÊEêÜ­¨?c¡ê¾æ]€Ë-%ÚF#¨ï`Óåjå«ha\0@\nÔğ*Úàh„";
            break;case "pt-br":$f                  = "V7˜Øj¡ĞÊmÌ§(1èÂ?	EÃ30€æ\n'0Ôfñ\rR 8Îg6´ìe6¦ã±¤ÂrG%ç©¤ìoŠ†i„ÜhXjÁ¤Û2LSI´pá6šN†šLv>%9§\$\\Ön 7F£†Z)Î\r9†Ìh5\rÇQØÂz4›ÁFó‘¤Îi7M‘‹ªË„&)A„ç9\"™*RğQ\$Üs…šNXHŞÓfƒˆF[ı˜å\"œ–MçQ Ã'°S¯²ÓfÊs‚Ç§!†\r4gà¸½¬ä§‚»føæÎLªo7TÍÇY|«%Š7RA\\yi¸ÏÛäuL¢bû0Õ4à¢\$ ËŠÍ’rFùè(ªsÊFWFØ\\‹Øß.r€9 P†0Œ‰\\\n&3ìR.!0\nú½ã+è÷¯°(§ ğÒ–©,Ûî:ÂKË¶•µÀP„Ç<pH@Ş©(¸ŠèÀŒØ˜7¯ãr@¨'ÉZ\r¶£òÀ¦ƒü&¤OSÄÓ£ ëBØƒF¡Z’#rŒ¦…ÉoT›'À¢pŞ¯ŠM\$õ„£ @1(04Ísko ² ÊÃªÂS˜e¬æ ²Fù?\"âƒN1ÌÚhÁ&ˆX@6 ,'PLˆA#F9¡NˆÊAŠŒ~§©úñ ÃÀè½4ÄO#bRÅMª,1§Ğ3èŸ*¢˜¢&2£u4ƒÇÈàƒ&¾Š¦1¯L[Î?c))J¬VÌEñlÿZ’â`ÛÑ¯¨‡ÛãÃˆ·0ëÛ!¯ÛQˆC&ÃHØ/ïğ’6¤(c(\"ëá\\6@£YvÈÈ»1 Èl¤¦ÍµMb^ñã0Ì60+Œ0³IĞŞ §ÃÈA=c¨Æ…\$c0ê”ÒÈæ £–L0ŒùtÀ‚¢é Á@æ§\" Ş5¥a\0†)ŠB3È–(xâ’šZê£ƒ2ø6åézòØ®Ïå=¤­ìÖĞå(S\$Ş¸Í¼°±à,Ô0æ—è@35ëå]am°7Liä}Bk*\$pæ;¯“RÈ83C(ÉªĞÑŒÁèD4ƒ àáxïÑ…ĞF~……ËàÎ¥}eT•r^8cÎ÷óBıjŸ\ra}}\r®Ä:xÂg­Ãø:(UV'ºCÈ:Gc•K8ÍÚøßÀ,ÂG>¶öË`Û¾\rk{2z›8\r\nƒ2ò1©ì^Ç}ı‡ÀÜ\n@ EÒş7¦à€RJ‹3î2AÌ†âlJ	ÉòGÁ¤3•p«Œé€ÍDªrN¡Ñƒ¨¸¡BŒ€Qr¸_„‰êª\"©#j…æ<ôŞ	¹0/ÕÁ¼˜\"ECÉ«EåPØ½C0vNÂ4j4³7sNB§&1¤†5 ¶aÂáÂ\0Â£÷1Kd»¶:;,x&PÈHq18j” -ğ …D©—eÚ³té‚Â°jb¸GFíH ˆôšËğ WÁ1»¯cÆÕÁ\0F\nı^HVCœN>„Yº„k‰9¸|‘©Û·\".³‘¾~A<'\0ª A\nIËPˆB`E—da¿sÒa˜¨¸(ñ†(Yë\n¤“¢xOŠ“\n¹BÀÊŞ{Ô.Ó!O„4.tQ*¬2IÙ\"NQJ;…Lj80¤#ê’	<:aA¤<¤ÊQçÊ*ah¹†´ø6(Z”J+º¯XÖƒLz‹lå¶'IØµ¨k÷^KŒ—˜RØ ‹l‹ ÂÍ\npPí¸ÿf¼PÉ9ŸK¤Å ¬BÛ{ÉO&=\$¨6*MÃf,Âœ¿×şV8Œë0£ÓºRq‚\r\$8ÍÎf!f³1Çn©ÎSèjŸ\ng¸1`È”h™”\nÆ}W“º´®¦ACF˜,ŸÒÚU\$µÙ–)2úíÃlŞ,ÆVW•§:Ø‰0r ñÓIX[‘:¯îÜ9u¬K5/ÖQy£ÀÜ”y€\rg² PŒÖÍôş\rçJ­„RNtOğD¤ŒËfS:i˜r4å\0ÈR”Ğ*på¥83JzƒzoMW3ŸéÌeç\n,‰Õ&·6iqS1¦&A˜÷­°\\n}¿ŒwMDSVèÏn]Ù¹à0İÊjj™?~§=R•X¶5Ô>å8[ë¢Eƒ‰)¼—U³,Ëuw^¹G>è\\p¹°x¿MÌÜ`cFb°IÂW”Ê*¤hƒxw\"ïíRfW‹Ö\$_Òvâr›PM¹Ä}˜­¸’f‘y<È€¾%ºSqÌ¤Xğ˜pÊM3ÃwT˜Â˜M×™/<D!\\5NJ­ÑzI˜êål–\r9	4a‹2ú³F¾ôÌëÇ¥d¤ãmê·tAl›[ŞNB~q¸ùÌ7Ñ|uá}Yå2ç°ŞV¾}içšãZÜctM%À7=bô†t0KVŠ„A£ØF‘!(fŠ¦#ù1•¡EU™º\\¤Û‰ÉıåoEÉ‚ıÖÅNn'=L¶¡©/×‰ñ,êòøœÂy¸®•ñğµ¤B4Ú\\F-jez÷:êõq@ £M€Ş\nf!ü¡k½†RMDkN¡”Š‡ŒèhÜüÒÛŒĞ\\è¦‰vêÜ”î{\rEhåİ”jçâzfÂ•«Ò·çÛ¯zt4z½×xğ›YÃ0%ç»öq=§BìY¯±¹pïYñ¦·M\nÓÜ„ØXâ}+y>ŠÚ(urÎF’¹+rÔ[ãy„*öÖ0&5ı¤¯àhQÅTş2Av«4A/ŒÃã‹çµë¹*F‡üK	“ĞOG,qÊæ]£E7ÈY+HQŸ©2ÈƒLÑ9æÍW’s¨)BÙìSÈÉAUpfì¾¸˜ó&…Öºs¦·ÿ*Âò†qÏ|]l3»ßRP®Lº¯Ï6¹bî}ÒN3‡œ¶ûNz7kŞ”ß>\$wØ,u}«¶ÃÔb’Â+S²°(È¹¥9S\rİ×*m­8ÛÂŒñû«‹p¿§<WÍù>«Øb`Ë“Ú¯[©V•\$Q–/³úéê¬yyİ÷Œ“Ã/SL®ÙÆŞ‘v/8K&£¼uôÚûı~dßïöşË6ÿ\rç‡Ôûc«\0@Î³³0³€¨ éªö\"ôÏ\$F/”ÿLğ¶ÄH\$&ô¤ÿp/Æ¾ú‡Ô	\r\0úD\n¹æÔ!c*_¾3dàû¦XÊÍDJ†~âj¥bF¡âø'‚\n*\r*ãà†R.NUc0išF¢\"MB¤4-4ãÂpÁp¦2íÙî\$»°Œ=@Øh¬\r%\"ÀŞCFOŞ×,¤:Ã&¥ ' Œ’Ç ¨š1†–À¨ÀZ´Yƒ\$;ËøâšÔLÔÄ¦¦ÁnÊ½p·Q€Kà##:#Â@\$Gb\$âRaäê³\$ïø‚€óc×¢.ûæ\n¢¦Ğ&0´ Ü\rpÜ|«î@\"õÎş\rbr\n†G\$\natJbŒ/DnA\0;ñ†MB\r#z1@Sk¢*¯€ÎÅX7ğİĞ‚1 äOEp€b·0a­Š\0ƒ£«#j7lèª\rç rQºÓñ¾\rM'q¹ÇÃ#i1Ø*b¢QÜ¦eÔCª²1©Tò\"H› …Ñj £Ê´\"äÕ©¬Œ®a²*ÛÅÚë H¶PB8A€ì4qDã‡\n7Ã2ªR\0MJÖ îJ\\QêRqüªe¦0-­C2ïÃ(L±b3oíC(Ÿ(ìIMÖ^	\"Iæª±Ù%Æ²PzPC1TMB[%Ä¢vã²@­<@jQPŠ@¦q ";
            break;case "ro":$f                     = "S:›†VBlÒ 9šLçS¡ˆƒÁBQpÌÍ¢	´@p:\$\"¸Üc‡œŒf˜ÒÈLšL§#©²>e„LÎÓ1p(/˜Ìæ¢i„ğiL†ÓIÌ@-	NdùéÆe9%´	‘È@n™hõ˜|ôX\nFC1 Ôl7AFsy°o9B&ã\rÙ†7FÔ°É82`uøÙÎZ:LFSa–zE2`xHx(’n9ÌÌ¹Äg’If;ÌÌÓ=,›ãfƒî¾oŞNÆœ©° :n§N,èh¦ğ2YYéNû;Ò¹ÆÎê ˜AÌføìë×2ær'-Kk{3ùºš>²±1¢`÷½“¢ÈL@Î[àQ2ÁBz2´ÃjRŒRXì¸\nB@»?Jh¼„8@•CÆı@ò³\nƒHàÁ/cäã(Ş6Œ££Zé)¨Úé'Iœ\nÄ'	x4°®N(DË¨ÂL#Ä1P#?3¢`Ş3ÄÉÀà™¨£pÊ3¢›(2Ãoc: Ã#£®¬¦Ú!‰£{2—%sÈ8<ƒÔ®ñ¼³LÖ4Í®S&6& RşĞ5Šêp76LèJ2|º:4=. £LhÊË®ˆŒ€Œt\$ Œï\$ òBÊ+ºò€°î’ñ:L;Vò5h||ş©Óú€ŒêCFà,IùMÓ(2RãblÈŒLª•Î¢&ˆê™5È˜C‰`ÂÅlS;WnER9¹òóK;\r3c®Á°°¬WEÔ÷5c@Ê¢Ú×5eŞĞ3J)Ü7ºYv¨<,âÀ‚ƒtŞµÍ\$\$£…VÎˆ£Æ\$9—ËI=2€UÙ#Â²HĞÒŒÛÚ\r‘pØ£r3ÃböË3È\"cP\nƒ{q*!Çj¸æ9ŒÊÙ'¾c€9g£ ½„…¦,P9…)è†)ŠB3€7r¾£ˆèHÄŞÁ\0¥¯*c3/\n*«Hê9³5´ú\n°Ä8Š†Ğ¡(Òƒ¥‹á	1ZPå'¡¸ìë»r´60îŒËB©èš0ÃêğáÎcºñDpĞ“Ã´‡‰`ĞòÁèD4ƒ àáxïÛ…ÊV¨/8_+÷ãÂĞ\r.à^9OÜ[×öHÂ7\ra}ˆ¬XxÂ**tXãÍZûã°ê*Ô¦9J³›š¬\r<•£ê™q¯r])/s5š#A°bÕêW!(ş¿òpyÌ‘¼:ïè1sq\0^!81Ì\\È¦#Ü\n\n“YFë)#¦dKÁ[d} †Ç\n‡ÁnĞX‘¥üM	±E(äyU\0kP¡™lIı6u”KY#Ğú6—6‹Ã” Ït„’.M’\r*!B£B”AÇ9'‘i?òZâÈğA)lÌ¯vÄÚ9¡8 §9ó|æŠÀa\rE(ğ¦ô(N\nì¢FÒkûn…ƒ’\"•™	‹\\„n’ø–çĞËß†\\îâ†T‹ŠG‘\r†’vAÊ‘°Š+1Ÿ=PŞRˆâ\$à€)¬ò¶²Ù,ÁP(È°Øà£å‹è¬œ‡\"všÒö ğ9%`vá2‘;‰E!„ÂXSRéO\n–góôo•\0DJáÔ¦i(ÑŞ{ƒiIÖØM_˜\nD!Á[†år‹\nÁ}³me¶ÊA\0v/«MP¢´æ‰Ÿj1!Ô3xl›W‰@O0Ø„PçBI…\$À‚\$Póñ5Ğ\"E=«¹w\$–¢§Ó2…•\"D·GA#q­-‚fhJª0I”2 †}¨Ù¸]‡]ƒÑç0“Q‰,N\n(¬Bğ‚µ\0&Té*À­Kçš»*@éî·‡üğ i%@\$KR¤€[¡{EÆ)†©WËûqpíY.iû2H4ËgI-£å?[òğKL”ğ€ª.LÏãkiÈ*P©]°C.²œ7Ó>aÃÁRKÉ<r÷d,‘Ò!Í,¹Ùe(Db[t÷0é1,i¥›Q¡ç“)Õ¢ ‡]©°A‡µº×#àS@•×|ï¥,Zª<…‰‘ÙT¸˜ Âª d²G¼ƒ´RN¦¡ÔdA¿§®¼Jğ¦ëê#Ë^‰Â:×&Œ6Pj'ZaQ\0¼_#S\rÔQÙW•Õ\$V›LªéqRF”£¯â4Eh¦Å¼ Áp	ÀS†<ïÙªÁHRh'rV@ái§ RQë‡¦N‚¤õG_{Šp¶+¿KG\0‡[tñ†'Z†· æeÃÆ*¨\r¸8°ïCÓúO\$¸ì”\"ü`i*™…o&FW 5?XšÎa” ’5Däÿ*”2¤Måì¿LW!?b¸’Ò‰t¸BhSz¯b_L4òØgvleyY/iPÂAX¡â_GŒ§õ<ŒPÉä•4²k0å—IîaºA—DÊV¡²„3T“M+”É33>ˆGĞ™àöùb\nª¥¢dıcùÕ¬	¶²Á˜xÅjô÷¬InŸBçØ:Ù´X&ê»YRt)(‰;*Là›ÅîGU«ÚikL¯IqH¸,¿²1,43ÉÁ)\$\$g9‹ŠÉCúW°°ìÒÃìÒu”;/»ıo±‡\\'ÉÜ®ƒ\r¿D!Ñ>RUÛOL^º¥È›LpfAJuÑä0û‚pêkÂvB5†ŠÑ®GµÖñÁÜVñ±¶?ÅĞ AJfTè„2V±Ì¸N,«İ\$3†/½ıÁ|‡Í8Xyv”æ8<ÜİÏÎ0L8p›¾!r.|ÍÂpµbb~­4·\rê,©Ÿ«S¤÷‡=Ãô“­Õª¯×º·/Ø|s²X¹Ãã)ä~D.‘ÀÒº±WåƒO}Ÿtø@eiOÃ¹Á#ÀXÌ])BÎ°×áŠ(Îº 4~Èf‰‘c a¾>±vI…Š:¥©ÖéïqYåãØ’ı´“}š[œgüŞçšóŠúğËa¢Úí\\/KÒOmî2ºãz¹Q´ßì,* »‰]]-¥)v—2÷wæ«îÁÓ{½ÍRïüı„R•PØ¾Ÿ¸œ×Êú¿ŸFå\0ÊHÈSÃQ#²ÆIú\\T§LêÓÃ†:â\\EÈT æ¤Îúíf3ozËĞ\n<0ömäøæÏtÒ†â«A\00R\$ĞõÜ¨pC/‹K® Ääª7C:Ş¢l<‚Dê¡/%\$lÉĞÒ¯¤Bòé°ûÏ°ö†ù°~×.Õç5Æ—äOi„lo©Øùk¼ı\0ªˆˆ>¼ğ*^'°®Gh@’p äp½ÌGĞ¶ío´	8^ÀÈ¹îic:\n¨mÔËdğå.Ô?F¨¬…L~è˜2ê/ƒğâ¦Bhä¬:\$şkã\"&ÅQ\nKîÔéÎÆ=ÌÃHp2Ñï³ì2¿\\kD\\\r€Vğ\rlĞ7\nB¶À Bh•&vû\"z'å”\rª+C&£à@\n ¨ÀZü\$é¢ÌXQ\0ä†ÅAÅV×¬gbLæÃæl†0I,B#‚<şFd„¸2)1 Ùbì^Eªmjàp`<#4T­£>”æŞ ñ0èŒxE¸’gä8\"ÀWà@AWAv'¤€W\"øBjˆ…ğIÂ”=ú”åš\r\$8¤†ÑŒŠöò1Dú°äö¤èGÍbFKmİìt×ÒP€ñ’‡dR=%ªT÷n°Òíè9c~6ƒl2fÄ\ràá!„xtã¤`%ñ&e”Aöäæ%%\$e¶‚ËîcŠ˜eByèˆ‚¥vğ2®;²´d\rîS\"b:G>Û¬êîälOît/%âI\"ò/²†Q\0¬&@î©4©¸@Ÿ(%jNNZ/ˆ>­ËBê­ËDÃ:rFÑÎ\$+Ü0\"û*Jv=Ò¸	³4«&&Nä£(£ôÚÒâŸ2é’\$ü0oÂlÂÃÈ @	\0@š	 t\n`¦";
            break;case "ru":$f                     = "ĞI4QbŠ\r ²h-Z(KA{‚„¢á™˜@s4°˜\$hĞX4móEÑFyAg‚ÊÚ†Š\nQBKW2)RöA@Âapz\0]NKWRi›Ay-]Ê!Ğ&‚æ	­èp¤CE#©¢êµyl²Ÿ\n@N'R)ø´@%9¨í*I.’Z¤3¹Â{“AZ(š˜ÂTq\0(`1ÆƒQ°Üp9Œ¯ğXi\$fi'Bİãğûæ2’•,l±Æ„~C>Ò4P·üT!ÕHæˆkš‚®hRğóHbúˆ°šÊ4ø½i6FFc{Y”…3¦-j´rÉ¼ê 4NÆQ¸Ş 8'cI°Êg2œÄO9Ôàd0<‡CA§ä:#Ü¹”)#d¡µîÃ ŒÀ©),zn™¥LÓŠÖ®ém&êÜ0¸NÄ.„A%Â\noÒ7ğd\r«‹’”ÂŒC8¡”h…*ôš¨ªhéZ¨]9kcFhÉNì()|Œ’‰€¿F¥”<^\$|~›BåÒg:ìûƒ1šªã&„:Â±È1~Œ’hkŒ³¹(bi/M.q¡\r¸ÒA¡­\n\"ĞŒ“\nt»\nÃ*’XãD’´¨Ï„ü­ª.‰ ¯«)ü>°6\$+N»—3Š2O9‰m\"è0\$zTY(…\$§Dè©%«i¡KP-[è(Êbá0DD&K<e`³TÇc´ŸDÅ­³!¶¤fÛ%­Ë°CXèÒïHÕÎ­›Y:!(ÈÔ§I¨u]‹Ü¯wİfƒUy0ô„“{I’H˜§ÊY¦—É —CÅœ­ÏhÍy(8(Í`‘\$uì»—‰TğÎZÔ\rc8j!+Hn¹|ß‹IÈÉ6¦©î|¨¶DÉòıY©q¾fíT¬äsˆÃ¨Ø6>pÜ‹Œcİ\n\"bT–:ÙMƒ1Íi_»r ÌN1k\n¨n\$¬ÂZjn:’°ê]ŒEÉªd[Rll±Õã#iS€Ø M•¯Zn¶ÛĞ»Ráé\\rµ]Á¡ªyağš¾î­ tşù¶TUÜ2°Nğ4İ†šJŸ“&2V¸*gIEÎ2X×pNm¼İÜ7»«½%¼¾üÄIWë”6ƒî»ãäò\rã0Ì6Ec*æ€´µ0¨7¼ãn”<„¨Ü9£Æøc6„\rƒxÏacæ9{Î0Åaãx\r±Xêı˜R¹ºpÆxªQÊ³S)¼«0¦‚2ÜW«L¥PaÖrÑ9æ\0œ’Rá‰R<+Å¬¼òG]QBqF+ÖjLMÒ±3êÍÃ FDp]ÃÿgÇaÅ”¶S0¸%P¬›ñtúŠ™Cdù“”ÈˆqÕz¤N*¾*—\nAJ8M!Ìı#ÑÃ˜w\ráÉu†PğKÇ4ÀñÃ0=A :@àx/ñÌÈıCpe@º-†p^Ctéí†ß AEGÀ:F ¾€šPk@ø\$†Ğà{ƒl€€ğ†|[Ï”™?½uŸ@@õƒYä\r!ĞôG§­Cpt@†#R>qÑa5-õf„ÄTDpÑkE…ş\$(8`abn¥UÄ©ns	‰×ˆ…ş'8^\"*¹\$ó%-¥Ê‰…¼%C}B¡´LÊâ{˜\0 ¸?¹š³Pƒ?€q¯³¹åÂq-aIÏtM\nW9ÈS ¹¥RJg3\n!â\r 2v®êJ\n&qÌPFMyêK´Â[-˜•5ÖiF¡¹‡Dâƒœ’\r4›é³ŸHí’¡F¡¨ø‡%\nJPp’EƒÉŞ4®³Í+œ€”§ôù<pâOŒ¬ÁÈ7†Ğ@c»ÍŠÇò@\0Æùj	ó¨‘\\øK3t4ac,^|ˆÊÀ©	QÆIb)Æ‚\0 Â˜T®X°›(æ‰,#«æz¬¢Y¦Ic.õ®¶×ECÙ£(!\nM¬Ó:ø£(-O	‚—rNhJÅae4ã\nĞ†&S©8nòš¼:tÒCsÙ’á¾;ÌƒHgM¦‚\0Ì{O!ìŒÁ*\\—Xi’ÑnVJ»mS*uAG=ª2|W‰¬—ìV0T=9Šr±8Î‘”BFàT«a­,^#‹¿tX*»¼J¥±\"TĞFÔë+Z†±“1Dù|	•ò£”Y4FKªrffè°8ôû’?ZÁ2†`ÂĞ¥`v!²¤‘4ÆS6í†f'ÚÔªâ;0hùÍ(W-½PÄÁÌ©lLà/bÛ(—Ì[‘š^p+ÙÊsIHÙ8§&§›İu¥ÍN\$g+l91ÇdAçz®Vc¶+MæÃR—ZL‚Ì¼¦G92\nîJ¡LŒA@¶Š4X7(+ë¥º6iª\rU\$”Gİ:\$Š,8QeÀJ[‚@P©2m¢*6µnÉpI1&¼Ø”Îˆ3îŠzò8”tFMñÚ»e·O…¡w´:]Àv®ŠHz (!ÔĞàıõXS§¸1Ÿ É”ş9SB}M?y´:µ.¦ãR’,æìîYúrQßëö!±0†³ès¾jSÕ3´5\nC Ì^	c\"së=ó*É`L,‡S\n-_q»h°ÉMŞ%‡ c9>0\$œ±4Å†=8ÆŒªO\\‘ÃHÈ¤cí\\š‘‘JÜ'±b«8’æ“Z±`ú\"€:–šk)N:‰>æ ÇrÆWÖ¨ó\0¹b¨°&«ƒÄÅÍÇ	6«^\0¼Æ¯	 ˜IôX)€»¦!qÒº?M#\"\\–ôÓñó+¥|^Ä	Á†n~-ëÕ¨.xV#p	Q¨æ~®¹¬Y0ëd;¯,š6´àúğçì@\\v×ÕZ—oì½Åcw>»b¡`l¬Ÿ½vTÊvNÜÍ&¶UÎ ‘hî¢¯*œÓÅ#!Qüo€íŞh±yÎÂ/aA:÷B\"vŸCÛwòK^•Íúròf×?¬\$»²z/b¤=%+\$~Ú\"ĞÏUœæNøK,åË…qª`w#ü’õŒA‰cväe¬]—öo\rŠ„êd·ëYÏ~Ù{-Ÿ±ŸÂQzÇ°G”lX Eb¡|&ÆKõ}ÒàûÈ’;D–üÿ&:í‰àøÎVßrÿ¥NÓëÊÚIàOJÒ¬äLç„Qª*k°*çdÎ½!0Û\$ôç+ªÆ\$†Ó%>D&Äde~Bd´\$á\"üc¬]PÉfÊş°dìÃFŒ?+ÎfÂç\$áÿæR-„±ä®Ôn.m†bê¾`d°In\n'ì”*é	ÍI\n%=\nñÁ-FØ¹\nb¨/«´Ër\$	Š¾0ÖZ¥¹…¾ÙäâY¯Æ£)†›ÈJeŸ\$ÜD¦*ÓVÙ­t„±S±Úëğ%‹õ uí¼ÿE,²\"B¿ÆÖÙgüÙÇ*ëí¢ïDäÚq2g/ôÂép²Íd0À†l'\rËÜc¬ŠjÀT\nR—pªfâ=š#1fÈÖ°ğ\rrCÊ\$£pXÀ¬ˆWÑjwJUĞĞÓ± A0pSq˜Ê©Õe=ïL¯ldÊL¿vzòdŒt0ÎöB©ÖK€ãÍ|¡‚°}O_P‰¾)¯öÏêíQÕ/ƒÑ¨ÌÄ\rK4ì÷°fLÉ«óÂñnı 1ööqÏ °' åŸ‚A!oãİr ¡Ñ¸l²(¹ÏİK*İ¡O»\nâB*.¸yïİ\"šİk¦˜2_pÀ¯Â¼!ÒlİG%Øº’{Ór„ØñNÙ.œ¤‚ØˆnCãBn)¦lLå á¥¸NNBáç0ˆ`CÌ¦¢Vúë¨l‹£Ä¤,ÄáÇ6Ce§df±F\$È,CX#ï2f\r<dò¨ c¡†È€	öFr‡%rs%²‘Cµ,å3-,¸0nvMŠÀÆç-.ÃÍÈ9Ìe-ÑP)g½B™Í~¥‹æ²K'ñºõ¦×³Wë÷5òe5w6sRãëºØ	—5ÑÖˆ¬×\rDÉfæ,²Be5S7EªÊğ©³…\n¯Š×1‘9.T´sªısa%“:Iy6ó‡)jé9\rÀp-ñ8³§;‘¾æSÖ°sÇ:%Ä9şır&áØâBCm|ãMú å¥\$/¬ëÀ»DF&âÇMxÌò#ĞÍ Ss6Ñ«A²95T!&¶îÓÁyBî?C1´ûâï)”<t48ù‚RänJ`C°e´Q°%2:&Nå1Á”ZÍ_=ó–F”iClTnbKEr0‚B\$à´dæ.à/Ñ&j*‚°Iíä!t¥\"R&­ŞOBñK\"Ó'Ñ¤rÂç3­¢ûN˜¡4 !t}WMtÂß…m7¤¸OS=¦Í@*(&PXçi)T'J¢æaîk1jø¢”·\$â§KÊñO®lUm¼Bu8´L.aJùV8ç9Cî;F¢±O‘İó?B·qÓôÏ/ìr\rSìÕ\"³ÊîY]#u`àpÙ fğujñuoH5tRæÂòŞ[DGN–†É°ìps@©¸Hr-•ÕnñÅÑVPªšµªÉ‚ğ†&uµ;Ô¹6\"ó\\ g‚g‚\r€Vİ‚šLE©be\rBÇÔ˜Je(3YµË=J@Œ·	N¨¨\0Ä•KR\n ¨ÀZ\0@\0Æ”„VôÎV‡W-)öìNŒ0È^àîütScQ’šv:ß(Md60cöIS–L]n¢P)Škô&ßÓ˜Qªsìe/‰êœã\næÔà›b€Ì3\$¾Ôx‡ ×¢•e¥VÇTĞÜ\$:ªëí8&4.è†öîŞ¾°úÄjÌË®r¢AW_ôTAv…Î™¤3/b¼îíD	‹X§„XVìµ Ú‹cÈ?\0bIiEs{2‹dÇhhr² š¢KgRØ4µWCIªõlÜşq=rwÍ>)Š<ñõ’5ì›q'gs×huf·6@¨hÃâ<Ä<–ª Ş\0èùíTŒg q¯õ	÷NÔÈw Ó	s€óÔøLÁt‰—x\$¬s,Í&_(*Ç,GvÒŠ×zÑDÙ±HÍ„\nMjÈC	ék*B3¥e\"ŠHª\r,&Õ Ê]`¬\r Êà\nÀÂ`ê ÚTéà´fb&U7iå4`ò¶À²…ø	SÌWfäuIâÄ0gJWL]s0MÆõFÆ¡Œ»4,§¬„ß¬^cuPSQMWFI †xãò<‡­}·ßw`@=—ëèBLÑb4øE|£NÎXIáNA )!9ˆ„\n ";
            break;case "sk":$f                     = "N0›ÏFPü%ÌÂ˜(¦Ã]ç(a„@n2œ\ræC	ÈÒl7ÅÌ&ƒ‘…Š¥‰¦Á¤ÚÃP›\rÑhÑØŞl2›¦±•ˆ¾5›ÎrxdB\$r:ˆ\rFQ\0”æB”Ãâ18¹”Ë-9´¹H€0Œ†cA¨Øn8‚)èÉDÍ&sLêb\nb¯M&}0èa1gæ³Ì¤«k02pQZ@Å_bÔ·‹Õò0 _0’’É¾’hÄÓ\rÒY§83™Nb¤„êp/ÆƒN®şbœa±ùaWw’M\ræ¹+o;I”³ÁCv˜ÍìMÔÎ\nßò±ÛDb#Ì&Æ*…†­¦0•ì<šñ§“—ÄFyÎfÃ(ˆ˜+Ck‚8Ã\n)©;Ø1Œ¯J™£È!.©€ä¸ã(Ş6Œ££2‡*É†T¨pÊ9'£(3ÌƒÎä¶Iø\$5Iü0¶ëkú(#Ã@Ø˜n\0æşŠ‘CÇ„\r,} '#L+#ƒôå\$\0ş‹C{êö8,<:c¢ ¤=0àÜà#CB~¾L²jˆÛ°J\0ê	ÎBv7c[úŒ\0Ä‚€Lù?PÍ>ÏãSZ;>r‘[!±‚0ê7\rcœ#8ä2ŒîŠöùÍEòøåCXÈ2¨)úzùK0ôœ22@Pô¡+C‚à&%ÃHèÿ…Ó!=5Š½LR´ı\$6\rc\0œ!ƒÂ7!Âˆ™\$­…lô=S«Z	#pÇMÌÕØŞ:&Èó:»ì›Õ79m‹\0¶Îq`õ3HN”F6Îr…È¹(ƒíNbşõÊ±ÅŞPPµ¦²13¿¢HÚUØŠ<b•İõr¸ƒ9İÃtÒŒ¦Æ\rğÎ©(ê˜7ŒÃ0ØºŒ©H2Ie‚Æ\nƒzBõÃÈAIc¨Çc˜Ít	è7acX9hCÎ0®¡³A«­´2…˜R”‰ÈËø:'EëXá§!\0†)ŠB0\\fîÒc])ƒ2'|Gå\n(=4nNmœo£œš¦-c(Ä2ÇÉí\$®LĞê¨µRŞ7'’ˆäò¼c¥%p­’+j(O<À9\nR•«1<“cº'>ªã€ÓMŒ›˜x‹\$ƒ(Ì„C@è:Ğ^şH\\¾k¨Àä\"c8^œúcÃe¨\r<¸^YC“R:xûqga}‰	ÅÂã|¦µpàè4#{X@õjeu\$Äúr£I{.aÄ¦bt*_¸uH\$X1’ˆMI¹9Dd¤¼—²úfå<êm3 Ğœ“ŠQLŠĞ×Àp@vÌ±LN@21GRÚN”PhVÁÃÎANliÑ³#ˆLè3©RÅ0ˆÂ¸„ÉºÔUÈ7œh\$ÚY-%äÅ ¹œ6'À49~+[˜Z:õ/8ˆ˜İ3ğ%!\$…‡“<•CJ}4qaÃäúüÍ©˜¡Ä:š¨°¢b!‘æºçæÛC pÆ°Ú°àÕ™ª+Z¬Ìò“Â|P@P	áL*%T¯S1åoxP—ó‚N Q2‚è[×I(!¸30êqDhe\rQÁM¦^ĞŠqœë9Ìò@_b.`€)­ A-VaŠ\"Á*ƒšÓ\"qaıÈ6C:)%!:†@õY?\"8µ3]LA<'\0ª A\nyÏPˆB`EŸiĞ¶œ‚èpYÔ„PiI_‘%AQ(«Å|PèV‰¢úŸç|WDX9!²>€ –†ßú’QÅ*Ç\r\$‘ªRd@¢?E7LZ):WË´›§6ê–Ìcel0P°â,ÈQÑ)Œ‘0†„D™˜ #ed¶\nÏ@]µ1x5ö¹[\"°„æ–\\\0a@E¬7´ƒ‘L`2#!ÅıFdO9È±NOÀ ÈVDÖ‰ÌóCWü)[9£\rµƒ^ÊtóNX¢È˜Ã˜jÏRáPÀ'CƒHzA¡\r\r‡¾‰‰Àc6A’y†J¨L9ŒEŠ…6YÃ`ÏèS¡è8PÆ–ê§IuÛ–]nÄ‘05\0 †“‘•Å²¤x@Ç9CÔ7\"úuˆÚ&Gƒ9©j”®êœµ]xQ:+«=ÿ¶š¤¹±…d×€ ŒŞĞ’­¡•+«ÆHäŠ¤ÿ%z¼Ç z-»‚µIsúÃAô;©UqÄ Áy^Pff†µf ±„Ãøp ¨ÄxyÖ¼JqoÑd¸ö)ˆC«Rª©3DòšŸnËB\0¸âu¬{1SŒ‰8¹Èß“TN4'0J(<sZP<ÇØ¥Äâ¼†ä1&G&ä…yä¸¹åQmB\"\nX.Ã1û	\$NfYÙ©\"²ñrë>ÆfF_ÃÖ<ÎE’æØL ó¹ğÏYo6g<¿ 0ª³Ä¥(fÓ®ìX‰Ü†I›Š)SLšZª\n­#Fš ĞvÅ˜#ÉJYœ¡°ŒU\nvkî(äM÷\r«ñ´Åe!jôT5tMz¾áƒ’Üç(¥?ìSè„‚AµLBÍ¥´•‰‡\$¦(¢cÊ‡J\n+ËjşsºOY.Ä¥'Ê\na§ĞÂòa»7Ö5@î›¸\$(IM¶³Û¼‹U4=l7ÿ³¶á?nl•Uøátc†ïKWøMÑK*Û”\$D\røsÜ!ZÆ\"79Êd¯hH)%O%Y‰®Ö«\0ÊN ®<ójHŒÈß+¸Ø«Ôòo’ríW<(µ®ˆ\r»·¡s:.O­õ.²>+ÁmwªÜg®0~½¿\"RfŞÜG²ÔŞÏÃ¸ºåì•q„pNÆXÚü«}v³˜Íl¢b¿¤—¯Ê®ü¶2‰='dìÅZ²—¿‰»8µŠª>3?ã”qï’ğ~WÃù5—1®‡óØêµfKv.ÔêGŠŞû_ØÛLãö´]»»í|åŒ÷S›ØİÏf#}¯q\"q?TÜ°Ş“´\"ÑŸıBPd	oİ*Yrfó©±NÍ¨:%¤LÓïÔß®ı{x³¿jøò”EO-\\tmW « 26Zíì¬”¢,şBö®ÚGR\$ï†»/x÷Ï¹Ë ım<ãM«Œ¼„¨+*·ÍÄ¶…ñoRøP>MpBY.ªª®­ñ’.0÷,ïG!°À\"„(Ñ.İpn<pr9nĞø.\"À€(p„î`îP|ÛCª(‰Ëãï*Àhpq	Ò-®G†¤Ç.IË~	bLÄ¬£¤ÜL(–hœ'Ox nLFôğO(ğ°x÷\rï/&¿Ï+n\"G‹öôo\nùHlâ+¤(†–R…,¬åèïDLeó	piå‹ê¾ØpÿÊÂJQlêü à»âæ¼Ok°Và+ÁLfø0YĞ\"ŒgO™;ëÓ\n‘g+Ò?\ré¶LEäp’ñFì0U\$X¤\\Á‘‚'ïqWñ’Á±™ñ †ÑVØ@<°FÜH´V-€üê1ŒöhpÔ—+ÜPjØi\rª\$ÀrğÖIÔò@æ0 Ïc]è†1æ¿`æõÀ–\$ò1…A€Ø(\$J\n±ÎV1Ôß\$œ\rn*\$#} òaÑö\r	ÆCÀØ`Öf`ÖLçD&h¼<ãŒ(&¤L\"&I¤A‡Dé#\$% Œ#â˜şH°qnœÀ¨ÀZ[Â6:ÂS¢\\c-ìmOõ€Û¬“(i·\0,ÀÉä!Ñğ›2ˆ.J‹²Ê\\àF>tb0æB:#çdÅT€›'àÌB@¬†aJ\$d\$5í¶ºhTLÂ’6E\$.T\\f„#Q2'Dÿì.%\nçDô£ö¿†Ò@˜\râø:Ó1Äú\r¯–¬ƒû ÌêŒsÃ®\$ã¥€íJ¨‚Üâ3Îìq*r[Pï+<â¬’ä@ŞQË.Î—3®‘‰³VYcT•ÃBOÂ¬sbÀfº´Gr!ÆH&0„M0M-@ó©\0iLqæ<“Cê)êì0p‚”†4’âƒ	œ¸Eò£hLk¨ü\rà\nLBBBV6C2fsŒ\0¬IÀî1 ÂºàêD¦8èÑEH\"fç1€¦–d<Ëc’1†.0¦sBÚ-òä§*h§œ—S,íÄ\$GŠd§C¤óec&e7/¹>B÷>‹ø'“ğEfúZ\0¬ å9l@¢	\0@š	 t\n`¦";
            break;case "sl":$f                     = "S:D‘–ib#L&ãHü%ÌÂ˜(6›à¦Ñ¸Âl7±WÆ“¡¤@d0\rğY”]0šÆXI¨Â ™›\r&³yÌé'”ÊÌ²Ñª%9¥äJ²nnÌSé‰†^ #!˜Ğj6 ¨!„ôn7‚£F“9¦<l‹I†”Ù/*ÁL†QZ¨v¾¤Çc”øÒc—–MçQ Ã3›àg#N\0Øe3™Nb	P€êp”@s†ƒNnæbËËÊfƒ”.ù«ÖÃèé†Pl5MBÖz67Q ¢>Ügâk5Û3tâÿr¡ÏD“Ñ‹(ÅPß	FSÔìU8F®—Æ*‚–0‚©‡C¬si	0Åp]Ş'r<m¾­Æ”0#Œ£xÚ2ƒ’ÿ\nm*á *D†\rnûÂÖŒHc°6pşÍ\$\0P„³=\"ƒ(›0 Ê\nhÔ2cLHôº‹«(í\nZ\nxÖ0¤I0ô3µ£ Ä´Šh Ë¶OÎËŒ\$\$.K¢ì´‰ÃxìÉŒ£\$:!ã @1&# ËÓ\0Ô¹Ìs,Â4Í2üÃ+:n¨ÊÊB0ê7\rc]‹C ä:Ç¯;¦ì!+àÖ£Iâtâ#I,T²6ÉˆŞ„Äâ`Òü.oPŞ6G±bXª=C+€£N£¨Ø63‹£.Šh[¿·¢˜¢&8ƒ\n22TKDh™Òƒ²RF¨89¹PD2¶S\0õ\"Xí•‰#­\"ª}_Fvz2äÈé½•ÄN0ÇŠ£°Şú:—éi–¤¢ºÃ¶SÒ4ÎS ÙLSş*#0Ì*	x2D‰0çŠƒ{\$6¡cË<7c¨Çoc˜ÍS	Û†Œàå…#8ÂÚ6“ @ü\rÃªaJ^‹§1%ÎGYx†)ŠB0\\G.Ãp’ C246ÔÏà@ì V@ÖÖ‰|E1é¸ê9+°5Un£F‰`Ø«g’{KøËÂ´ÕÖà(\n^&¾(ä¾#˜îKÃ(ğ8\r+Ön&í`Ê3¡Ğ:ƒ€t…ã¿6Ù\$æ#C8_drcÂ†\r#xÜ„UHäÌœ¾Ô!cXD	#hàËÉ xŒ!ğ@¤dp ÑæÂ¢\$ˆç„*v“X/x›àzÂ2ÖËé\"M\rã=&FÙ\n´<‚·£\$j”§ƒ²,©eıÃÂ2 ‰(Ğ“ûc§»ãç@ \n@R¤ÑeÄÜ\rùXË–±êƒ&·‰q0&DĞFµƒ°yÃI }Ü£ÇÎxMÁk	’%şZë_#-‰+@DÂQÃ™/	\$L<˜²NRñh'ì7%àèiÙ!ÔÍğÌ×ˆàAKE¹9š6^Ég…æ•¸–”AIÉ;2Oî%gØxS\nŒÜ-<\0Ôv ûC0\"DÇÕˆù&<*ğ…&rGyç}… ÄÂeZsLù 6ÀmÀ@¬‚` Ğ\$n‚£ï!iyK¡2~ïaºDÁÈ™‡\"^\rÑ&\rfà:¨Pu[Ê¿Dä7¶ju,ˆÌëU(I'Êl8*Ó¦€Û­Kfµà¦”á##À(&’|Z2¡Á…Sõ|! \n	h	d0ä¦‰A»	0à™„BFİÙ²zS=-ÖlÑp_äøØ˜ö]‘\",]Ä½‡©TdƒÑPY~§dI–RÑZgñú¥c%>O©gVÆL7±à‘HÚÈgaÙ	4_S™İ&ÎÌ9ƒª(–ÃÚFÄŞx¾×ŞRÂ#1ğDæ“ÀéE©\0OdÍ€ ´¤ÌÕE	HËœEà‰Â™…2ìCI¡jyDr’ÒÉ|\n”Ğô	YPœ-:&½f’bÜ®[N+Šg„8’u	?Áí›³Ønä™¹!5†_@” _+\$Ñ\"„¶†Ä ù™¬T·!¨íÒóØ˜¤¤ô„f~J^\$«®¸=kc\"6/‹¡uä&]é	Á„8;²n•Ï\nğ&i¾2 ^V„0Êµ6Ú¢J­i…µá–ØÚ·‰h’Ê`DÅ4ö¢ÔÌ•¸mŒµ\nÅZ¹GKÖ¸Ã•`nºlíbß5!B®®Ä®wd0\"æìî]²0á¤\\ğßt^D·­Bë]€õhîÕÆHë\"ÎûÀN/ß¼·B÷Û›Óoõì¸ÎşÜ0ÃqVl\r\r/¬Z›òÊÉ0uV:İòwğ×2WLÀÜ|İ÷´80^U¥oğÑ»íŸbLÈ±£¦›¶l7‡\\Ö ¹HÒè’à‰ïn7À´…@¬ayñ\$\"À¥ñK)€@×ƒ¹ò#õ´ ¢X•û“YT¡¼\0æ–ƒÒR… —›ÙÈÔ¥ù;='¯.”÷êĞ!P#™“³H*\$ô\$Æ‡.Ï¢æ‰J‘µ³¶A£´zE±’#Ú\r>='´`%Ú9P³\"—²~GË„İKH\0/	JÈ\\GK)o\0<ö¥ÈÔZl:;F°‹ı\$‘õ3\0O	=µK]—&íß9ªÕ)»À\r=tŸË‘¥§§å’ÇêBegq¢0‰f`WˆkCÒ¸'HÓk–m´I	œ¯ V_l—mÀ‰Â±zÚ¥ğ\$Õ*²À°Ş	»²>[Ê±¨!*\rD1¿	Â§C)&uïNİy­§˜¾z³±jR\n¥àº¾ØaÏ°å±Ğ÷\rkÉ\$q‹)?rËx’L„ÒøÉÔoÀÁTjbTÔC^»ˆ³ŞWs¹EÍ9­c–IŞ^Pù–¾ÁX¨›àëWy\0O9å\\òóàßÌ:YÛ£[;ËÒˆ_+é¼»§ô\r{Ô v\0ê¦G› AZd¨Ö³ÊzvZÑ%N\0ã—ÓU\"ÍÚ;ÔâĞ7%UÃdmÑ¸YÛë~27Ä	)³0ÈÑ%cdICƒ7	åL¹“oòÉ½W:&ÔxW‚ñT¬OOœÚ\"©å‰7˜\rFH‚†dæ²<b}63·v~à#@U^ğDße5ºÃ¯¬mr•{î¨Tt™Ü·niOGãµÛ^%HKİëbñ~ëÇÑšJIŠkG>×­øWÊûˆ×ïq¿’RìuXâ¿W¾{ô ú>êûïô”:\\T¡,™Y€1€­`we¸vöàÖ1€ŞX¢øG+ü¢ùïÂùpËÏÌæp çğ\$½oØîªøôNäòEÅ˜¬Oe,0ú¢LbdğOOW«*ë`/£ZÄ–ÊØGªì'l¾‰È“OÄ¡\nêB‘j\$poì0zª«·ã¼şp—Êî>/Æ«\$<D+°F°v×âğ²ğ³ÎçĞ®B€ú…¨ıªˆ'‚ö6\"ÓP,SGî/…şÉÜ?öÃâçlv®† êìsg»ì`kÆ ç9i<ÄQ3N™pô5Ì±“Àì%îPsI2¬\0§\0«:7dÉ#á’ìD¼HÍX¼°6ìè±N/D¶¹ÑVî…œ2Q\nÔdéf×ï@æ¤°Õ„¬%à†@ ØnHËÇìİBz'ê:£~“B^ÈødmˆKâ6€ª\n€Œ pdj8âğ\\MqËğæìMÂ»Ñ]ë^éÂ—Î¦\"‘læÎ¬ÇñÔ»±&¾ë˜1,#4Hì:ÂR]m–—¢öÀò@¤.ÀÃ@æ²œ©0Ê<cE\"eFÜh:ÖĞÍâ6-Ò23ˆûC5D\nUÊˆƒ‚= ˜\rãl8à%¨æyb4#Ò[åPÛKt§ñè\"†&(°²zUqIé²¾­f]‹ì'†ğ6((«íÎ§)c.3c2ê| à\$£ğÀÈ5@Ğ[-ƒ'ÃhûR(	%z{’4U-v\r¢sJ 'Bx'ÒÚ‹ç¼\nÍÍ.éİÍğG/´¼•b°İ+lm†Ü\r(Ã,\0@\nÀÒ î/²£Ú@Ÿ+¥.^6@‚-ó8Qéº‘°éãZ0‰((®\"b¤)¼6D®OÀêzNC\ré°›îNéó:b\n%\"17Ã)1¤²'#2bò®ób¯B8>ıËº3‰l";
            break;case "sr":$f                     = "ĞJ4‚í ¸4P-Ak	@ÁÚ6Š\r¢€h/`ãğP”\\33`¦‚†h¦¡ĞE¤¢¾†Cš©\\fÑLJâ°¦‚şe_¤‰ÙDåeh¦àRÆ‚ù ·hQæ	™”jQŸÍĞñ*µ1a1˜CV³9Ôæ%9¨P	u6ccšUãPùíº/œAèBÀPÀb2£a¸às\$_ÅàTù²úI0Œ.\"uÌZîH‘™-á0ÕƒAcYXZç5åV\$Q´4«YŒiq—ÌÂc9m:¡MçQ Âv2ˆ\rÆñÀäi;M†S9”æ :q§!„éÁ:\r<ó¡„ÅËµÉ«èx­b¾˜’xš>Dšq„M«÷|];Ù´RT‰RÔ)·ãHÜ3½)CØ÷‚öµmjˆ\$í¢¥?ÆƒFÏ1EÁ¢D4æ„8±ª‘t’%L‚nú5æ\"Å&BØ¯O)y*,RÆÕ¤…d]!HbH¥CO¤*Ì2J³1Æ&™)ĞlbÈ¯%„ ­íT\nÖ#\n<±-Ò‚\"×=k!|ø5Ht~¦±’*É)ELZ «§Êr[1kŠHOÃ2‹Í±O;ä‚12‚rÎ¶é\$.Î³òÄºÎKji\nÏŒÖhĞ|{'¼±äb‹«Q	kã8²h3iO¶u\r,Î3Éı<h(²—K¾³Z:2 ŒûÎ†!-qV×lå{_×IÂÁ=ÂÌe¤2)!Hò£Qá›¬Ğ+;=¬J¨¯¿³¼l†O¬œØÏ²JYÕT„º¤?o;º³³Œ‹B‰!'pÌœØJ<´¬ÔÊ±ãé6	™£iÃTU31n&©¤šºÔĞr˜ÙkLÿŠ\"b	‰L¬ê59¤„‚v—…©ìó‡ÃxÂpÇ¦*”2'ÊÛåæGPTUÌÜŠĞEåVNÙÖyKCíU^R]m,5–A0Úd^UåF¦¥ØbéRhsª’ *r ©B-B±±PÌfÈ[¨l]Z¾õe‚ÕõÕ• Ñ³¥¯¯¢S}[E5ã`è97-Ø@0NŞ3Ãd2­dõC=P¢ Şâ\r£Ü<„¨Ü9£Æçc0ê6`Ş3ÀC˜Xè\\àÂ3Œ0AÛWÁ\0Û®¸P9…+Zˆ±¶ô¤'ˆb˜¤#cú\\‚R+´#UCKğÆìèI	¦¢«^vˆ§Íd8®è\\¢µİº–\0ˆµˆY¬Ï…h¸\$å‡_•P[‚ßksDÙÊM!Ìë‡#‹\0Ã˜w\ráÉ\\PğK‰<zâC0=A :@àx/ğŒÈîÃpe@º†p^Ct/]Ï†ßAĞq4:A ¾wÜĞk@ø\$†ĞàrÃl0€ğ†|Cº§d7«ƒ¢îƒk8!¤:XTæaHn…¬N.´è]™N\"‹Ğ›ÕFùTê[7¿ÂxûÅ©k3€¦7–0­•‚Ô&IÌŒDäõÅ¡ŠR¬ˆ›ˆP@@Pª©½&²˜Šª&Üò“æDğ‰“ÅR¦±\nI6Æš1kz(Ü”4‘zBdÉ¥Zñİ’s\\®Qaï“M¨·BÆ˜\$rŒ+mçÊSˆ1’Flİã¬VZ\nI\$!åÃ@Ò®]pÂ+£âCˆu9Ñt3 ŞA\0A„î>˜`ª›gBo@s›*•Z\$è‰…\0Â¤ˆ-«^bÌtúşä¢–D¦6“V¹@Éšd™/]-’‹B“GI\n]æ”áz4^Ù’t„?âj¨•š\"Ij(2„nàcsNv#†øLáÁ\0b\r!œ6:1Ê8'&`©\$œÒ¸\r1ÅØ¹P'4è›aÈàB³Ò¸y6>(ğL“²¶ñè¡\\4d•&p·BxNT(@‚( à‰L”Äj¤1<ŸR,÷¡`\n@Ui\"„À‹\\+•t\\¤I#40—‰E~°Î¢£GI=LÖQ4Ùuà¸Rr}G\$H_¶úec’1, ¼ŸàˆC0atñt;Ù8’ã—ì¸@6„QP‚¦]4Y‰ôĞƒLŒ—k¡.«t†nQW6­•BV›icH5ÑB'ö³Td”åÆ=3ñ5@¤©q\"\r¾ØôNbË™¢YMı<½k¾«Ê!m÷tø¿ú2 Ùõ•½”>ô·ÂLO®Ú×Påi¾ÖøômÑ˜t®ÍÖ#8¸°#§<¬(¤B”AÕ-zæ”˜	¶\$\$”»k·ªÖÒÕ¼şoãüy¦t_bĞIõz&Kú«ÕšÉ…‚GLe²…0Òƒ(\nsœ8;Ü’Ã)Ëg\\26’ ,SÊ¸©¡t\\!ihò!Mˆ–ÌŸ&ÒÈÑÜwU\rE¦¢Z\\	âBìÊŞLMÄÎkBH¥°Ş&£'*Ì·`Õt‹|pY’ò+yòßy\r¢/†Šƒ“—É>“z†'˜ …,æšK‰  dæQ\nçÕĞWßI9Ëqù°†Û~«‹bIå/ØÆø½ÏÌrVxNÆÕ<îAx VæÊA¬=ˆ„…†ÆhêÉ68 ¥:Ã%ÕñÔÈØÈ»R—î½Ü³Í¢ÿcQn?rü\0›«³öúÓe!ñ”İ®c‰UÛŠá£¾¼—7¦4;›gFİÒNßìÚ×¶Œï·7¢©ºfßtŞ˜~1A6ò»Ë\"lÏ[¿Û(rîä…·VÎşÅ¼j5\$‘»ø.Ú#;—Wª¬È^¼Úo‡“nî5Á—,Şœ‡—°ãÉ9¦íL|ß•\$‹å¶7‰¯	•.§Î`îHÉ+õ¡…Ñ®–vß‘sL±¨¡M­ÈÈbêex°0Îµ£²YYğ€§N¬ıQf¤}Ó‡mĞ¸Å9†cãÕX\n¯ä£Çóí‚Ô•v±«oë¥ †T˜·'yüÅâO®K&rVˆ™÷£p˜R¤nÊÉ–_©b\"–ªº¬(ø²L™,¯­/‡g\$¾KbÛÚƒOï9õ*Ô¸÷)3tÚé¸Òf-¹æ.ë¯v	÷_0¿kò=Æú-y\r¿¿^ßnÒøöWæÎ‹#7ñ\nÊA¢Øüƒ:/¼pgè2PûéÁseE¥F±¥œ¢éº„äÕĞ/ìB¡\$£Bì&\$RÒÏô`OL½ ?üúkHLŒĞÎ\"ÌiP¤Â®i=¥ü>K&ÿ‹63*k¼oœ.Ë ‘…3f‰¯&I”â#ÌùpX¼\\kÎ|b%@iïcdİMwÃú/JøF˜DÆœÒ¬)íîÕtÿ\" VMV—Tßå:\"ÈÜ>MæØåBá¥HáíÆåmÌïp°OîGp	Îæ½l\0áÍó	-ÊïDĞ”ğ³\rmF_ğ¾ÙcÍMğ&ÊèÏRûJ¶˜j¼øãŞ“ñĞ-eMƒIÉ/Êcñ(=o¯¥ğèæÎHï!+X*‚æ³¯.¶Ò«Ø\\~CèO¾2I<uæÏ¼dVkHO¦|åãâÍÌÒ}Ï´*ñ†—„L+¨şø±|ŒÄ ^)-¨ß\nEÚñMKãI-=bHÎä5fnC@ôcV»ØÄ®ñVUğĞË©ÏHênVÿ1ä6‘éÏ”©Tß½åSÑ ³‹ö+ªT©·ÍÂÕ€öĞNö\nÔÂPÕ1é	ïeÄâ\röÏ°&í{Æïíñ!Åİ Íc\$’#†rïdÂ5†ˆD*@§Š&„Rğq¤#üoè>®6)[\rC°Ôõ±\"O–ÔP¸µ/“(‘˜“2? –gnRÁZµ0Uò¬Í…FÁ‰?–Óò=êA+E¤Z’Ë	’@¸\nè&re9Ğşè–ğÚ´¡ rRlÒ1÷)üĞòşÑRš5s0rúÒ\r#ÑA\$,ôz0¤ÓÒİ,ñÚï‚\$ÑBI\0%RG4ÔòXEÄJö\\¢2!(ğS#3J²NSÓÖs\\±’QB\$JàR¨I‡)eÿ!‘”ŸmT«!\r‡.1r}­ş=±`,ĞÌw3”Á®æG®dU¨ğç-:b‘s›;Z1¢Ö_B™2fS-zäå|lÓØeh»¯X¡ÑâìÙF+¯:Ç¯ƒL3ìö’mMÃ\"(@†p`Øk­6Ë¼ş\$şB'±‘âª{ Ê„w@ê€Šr‹`Ü­`¨ÀZ\0@†\0ÆŠ¤î>á1æäcÚ¯bªçPàæ€™‚Æ”s´Û²®Ù“¿FJâI.ŒH\"kÙ+Úc%@™qÌcE<	´PÀòĞâZşD;oJE3ZDñbÃ°¡kÁJÌ%edığ“p<*±ãzL¼¡šôhüå>Ñtâ¯ò&½ˆf’æLe@òCÚf\\LÀú¥MQd»…)6BÏšbîc)X|J,ô¨óP±Rjı‡ÿG¶ù•'U\"½±øf¢mRõAS5M¦œ1™TâÖjÉXM©UOï ÀÅò€\\2v¼,VÚO¾ù¯ÎoˆÊ5É«æı\0´åÿOP^_uœ»Ñ‰LÌ£>Q®OX\n h¡@Í˜H€ Ò¶Ì¥p\nÀÒ î@¬ Æ ê\r³‹\rµ_Pr`¢¬ŸdÓ&nôEğY°ğ)Ò>Í4|Â*]W•&Vƒïit‰fíP¡\nuÿ3ó»\0†Ì4µ:4à†q#¬8'3\\•ÌÉp95ØÔ\"Pà+šT#QBKÄ%îéI+7+ì÷¢z";
            break;case "ta":$f                     = "àW* øiÀ¯FÁ\\Hd_†«•Ğô+ÁBQpÌÌ 9‚¢Ğt\\U„«¤êô@‚W¡à(<É\\±”@1	| @(:œ\r†ó	S.WA•èhtå]†R&Êùœñ\\µÌéÓI`ºD®JÉ\$Ôé:º®TÏ X’³`«*ªÉúrj1k€,êÕ…z@%9«Ò5|–Udƒß jä¦¸ˆ¯CˆÈf4†ãÍ~ùL›âg²Éù”Úp:E5ûe&­Ö@.•î¬£ƒËqu­¢»ƒW[•è¬\"¿+@ñm´î\0µ«,-ô­Ò»[Ü×‹&ó¨€Ğa;Dãx€àr4&Ã)œÊs<´!„éâ:\r?¡„Äö8\nRl‰¬Êü¬Î[zR.ì<›ªË\nú¤8N\"ÀÑ0íêä†AN¬*ÚÃ…q`½Ã	\no\0Ò7ğ2k,îSD)Y¤,«:Ò„)\rkfä¸.b¬á:®C• ÁlJ¾ä”ÂNr\$ƒÂÅ¢¯‘)2¬ª0©\n€ÈpŞ¢ñ	f”+îl·,ÊA\\«'\rìã DÊD˜›DqM:*´ê\nc£Ñ5rÔBÙ¥+¤¨\"-‚Æ– K£+¹ëšŞèD*Å×§Á@2ãhËA5Qt\\)ÄüıNŠcÈæû´*®«Š±2§,3m\0002OåYChH¢‹Í'¨ç^VS*#US0Â””©PµàÂ-´BÆ­ª²õ=M™ JÉd–·Ï(Œ™Ï·\\Š®\nÅ\\¤B/­OnÄ6u+m·0¤_)Ëã¤ í¹}Ş6}SUÒÊR•ºµÍá1âk|%(_¥Ã\$0ÓŠRÄ1”;7X­å%/u\"4Â#1ŞÊ~^u–C2Ø³ÑŠD³‚_8•\r‡@¡(É7-’PéZf#—åĞÅüWLèDÓºMî¤)XTĞ#£pÆ:\r#xÜ¹p}Ò¼à¬J~ Œã8äö¾ÛHİYMZrú¯Ì%uo2e*¤ãÚÕøˆíòœx±íÔ£¬VÕÄK«Uw}\"ˆ3×j#Qò–‡®º²d¬bfÃ{àÖÈ6\r‹üö\$Â7Eˆ˜¤jú¥ ˆë\$B¾Gçz,	xRW Áù!&1„ÓlÓ4äoHnfo)óYVG5©†kt-8æ²ã«ãø¾şÿ–üT~3ãCBšÒ 1M^ÛŠô×êÚQ©	3 ×ÂÓZ3=e\rû0ÖàòË³­HIšµv²Á{`-ï9ù>VƒßŒk|›AÄ.á3ÙWA\$Ó†ğä“Ä{Ï:B¡~lZ©½wëı™À‡ÔĞˆ]Hñ'¿÷E ¼]å0ÆúÑ	K_ ¬%û¢pØ €QÛ;¡…»‚\0Şƒ0lEa”àöà¢ØsAP7PÚíÃÈ l¡Ì:†0Æ{Ã˜f®Ä¡†tVÁañQÄ0†pÂŠÁˆj!µ‡Sî\n˜)+Á)… ŒR\r™†Ğ‰£x¦RâQZ{§4#…,ƒÙ’\nFol˜:v0ßœLÆµÄAÒTÇWÔeŠÌĞ ö®ã_c6qå^]¦xĞôeë@p°l§'4.Å¹V“®ñ”“G»*^dÊ{ªä_”…4YİóÙ/²”ÑÊåRåæã ÕÖ3Ğ#JğM*½^iæÃ¼.ia”<\0ÒİÃ\$¥„ï7pÌAhĞ8 ^Ã½ÅFåx¡pgá”7Q°ğ}Û[zà‰Ù#Ü(@_?îÜ5‚ }\n¦£ĞğÂ‹ùğTGä7´³ä#xk<A¤:eyè°n“>P\né¢ˆf™\0004ÑÆ1Ò¥;b,\"|’İC ÒøM¥|9–2éÈÊ†ä\n'å fìW	%ˆB\n=l[†ù€€  Hªnxç·*ûYK;‰	™N˜\nâäë¡½7éñ(Ğ÷^HŒ›Å½`Ä*™ñj±ÎÅ²ÙjD¡µYjõnÊÃ•›ig´jXŞÁ\$a5¤sÃÙ§XMÄ¾rÏáÇ:xMi-e§d¦&r-„B°æ\"“í‰\$¡3\0›“„Íôä¤CöZÏìŒcJâ\\8éà‚I'p@ÒÒÏ%EYaºŸ£àİÃˆu=õ3%Bd¢³ÔüÑÀ@ÊË>7º{ã€-U¨›7eœ9²¢xS\nˆQê3­<0¤z®µŠ¿X&Ú½‚»ÈöP›éÄ_®|<iÒ¡ˆ>3i@cmA˜4†pê›Ëj¼³ü2¶sÒl<ÁgHAh¿Bv¯#¶\rÑÈ¡F—A5MİhíUÁR¼»v–al/‘7ÒûÒ@¯ôº™\r9Ù4u0d#yhIk0;][Ñ8O	À€*…\0ˆB EYè@Š.\\õ5â¨>Yóƒ6¶³•°¥Ã\rjß\")¢àP\"àa§k1©ikÇæÄÑnc'ºû2+\nŠh&^>€@‚ eÁ†=ÔPìCeò+éE ûdûåœ°•Q\$T-İÕÎ8ë“í…bÚ¹©I	:uÊ!Ó¶qk²¯mê»DÏ*¦q›ÏtºˆšØy\r¶Î»qÃ/Ë±Ë	:H;§ÄÄ²\\Wdw¾ØVn¶%ïË‡sPó\\n7)„TÖqĞÅØ)è7|kMØö8~ä:¯é¢ÄHN”å_7VÌé9ei]ó’ÈE¾k`şÁ@V‹¥Ùõd@¥ò´)İ\0³˜ò~ O°u’\$lø4{S-@:º‡æûPÎw¯5¦6õNN:[šL¦cn>¤`8ÃE9½@“ğ¥®›¸s\r5*ÂmËCGÌ?\rÃÕÌÃHz (!ªá#¼S§±³†PÉ¹¹<Fd·bí>÷µ£4ÑfƒFğ»µ›ÍÌ8ß:ŸĞ1,§BMìŸ…ÑkK¤!ó¤2z¶P÷sc<&ªÄÒ¾c»J\\Í•ìU­kôÄô»;‰Bı;²4N şğWk3…óŒkb¿ê}n)7äûé{{?q®zÊºÛh°ªÿVlt¥¡Çtèü¯ˆ7 ¼7/¸\$ü#BèŞ†¾k¤,æ\$šÏ\rn^n‚D%ÊZ‚êcK2yn:ï¨”ì+ìgºÓM²·HˆfRÄR-ë\"ÑÎj‰MöÑÄæâS8Æ¢ƒ\"6imõïÂj`óÍ²ùo²Õ@ãË4un6áœ¬M–¸Í6à¥ï‚\"9©j0b:iXe,Øà„4àÆ\\Äà\\*şGPx˜p|¹\nææ2€‹\npó0—©±N*ånöærºHÌ\".z\rL€m(µ†}Bp/Ñ‡y\nˆvÎPÜx¦®C°+°^ÍĞµK–Pºû\n¸aÎÕN¡­‘ÁÌ-D‚è4âÑ)úzäkÑ,¸PìŞĞğ«#/:dĞV@˜Ì\nˆìæØ„ëbÅçÖ`b¸„«¤Bb€É¢Šõ‹`í†Šôé†&\r«†VÄq(q’|Æ`Ú1S‘VÙLå)¥Ë—(¢Ş.Š³DğC9£<—dlŞ\rNkÍ.š„»fäí—Í&:¢¦ø+0È©bã^¢†L‡\\Ü'š»‚ BÎ‘B•‘	\$.{ªÂG1´ú%8÷\rĞCf% PcØ‹…d–ˆ„ˆ~éb`C†òP6í†ªM¥ç\0¯\"«QToÑXAA8ciN›¨<íqôµRf'PÏ'Ğ2HèVVü‹vùñ3²wc€òò²›hÜ2làq·)2±2´‡	ÂZ/Ø·ˆdp¥,‘»\n²—-ÑÒ¾2š¯çû(ò¯.1\n”’é²ìı«4Ò±`ü¤À =®\\KPŒâÎˆMÎú\"~×-v×¬‚´1í°Fòäcjr\"Rëg—#\r0Qğó‚¾Më†ØÌ^‚s:õ±!\r#Îpö‰øçĞàòŒ‰)!-0’¸“qï>öxÕ/e7Àğ\0¨ àÈ7Ğ×	Ìa&­Xu%€—k‘1ˆİQ(İ°TN³¹#2û'RÍ0\r˜ôpôá¥Œİó]0ë5-§),qe.²Ï=ğ·>MÜsë5'îM,S‰³Ù.Sœh\0\"3àÄ³Ìu3‚Ö²ß?s?³Æ„M×4PU%G·@:øHp^°î«LoÇN“°r˜c[\"\r&PH/>qZ!Ò›ÑÌü4'\n3èÙ(rf±×p3\0iÏ&ÔU\"4Xl?/’,°…ôiÔo	°qI	e?	{=}\$2jÜ”d)ĞUí_GÜ`ïÁ\r²ÀàT™)òı\nÑÚÍq‹LÓµ2<NT+AOARxÍTÈ†‘;MğÓ²õ=T›M²æ®Qüå(I8ts\r¢šAãÄ”5Qã¨'ó¡3\$B÷3(Hâp·Qÿ@ğéKCPHŞÅx£ˆîilş\n€‚°æ®úÓhCP:A±ÓñQ>+&ÖŠ¬húdAµ;-\"U7N%ôıi­Õ—o;;4ªpÄt³P#9PHÑÍdÑÄÿUàƒ:@²\n\0Š°êÜï1¦µq/2nYÕz¬~—4ßO¦UNO—02º6ç¶øûDLù\r‘XªÅGI9Ä·’¨ùÍÔï¶d0åKT±SôÙA2ÿ9a”íG§MP–#O6'A–+8HMKT@›t×'69MÖ>ùäHPO•/hPJNˆÎ0“ğW@Š<*”°ö3]tïTsÛb‚Ğ«Zí Qg*fÈ0¡V78ÔöüÎl\"6jâ¶n›¶“gHae³%eò3gò•Ar{jVihÖ®~òEiVwGtãlˆEj¥¦Šim6´°öGfJD?OG_‡H\rd'í^%e\\¢øŠ4LˆSc\$ßH3gZ­)\ne2ˆbÕÄM§\0V\$à3[hrÃd±¹bVPh”ˆ‡W9\\Ô¯i¶/TR'C5c—Nª!]nö5dÖ¡,æÈlÆĞÇUûS„¥q@&Îö2ÙuTÊWrÇ×yvuÕ@¶ı¢xG‹`®Gy´Cf&¶r/¢t6AÏBAO»WôÿRóÓgÓõOo=Ä‘|7Lûôçm—W=vOP÷ÖLWÅ5•y–]yÕC~WÓhC…}…ù4ÎÒ+¬{âø¶ôúwí}µé`–Ñk‡÷zöòÑdğu6Üjöá1ˆo'Goæœğ/wËEõsgºÜc€´¸?tîc„qãu4ê{øOvR%VìJ¡…ØD^TÜx\$ä¸(Î6Ÿ?“\0		æ\rD²_vŒïJŞ†·	ƒ«q´<h¶ââ«˜Dğ˜¹-ª:´7ˆU\$³Vg^p†İ¶o‰I”ÆåtV–XÇ˜ÊàWTqLBáNj'òHmS¬4d-CÌFj':‚WñRp,ğOeryµk¸‹&˜düµ”€{Rµ×õ’—mh“Q†X-Äõ“TºÙîe\r€VÀ\0Ò`Ö‹Ì– ~Ø#ğÊz\r Ì*ˆ+ÀŒ=cÄ\r®”¨ Ä¨l–\n ¨ÀZ\0AU™vE‚½‹õ¥`Ö„ÕŠS…lÃkqÆ˜BR¹‹BøÛš•ôÓ;šõHóe›v°¦]›Ø¸Š±aœx-ÅKsù+×ˆâ)ÿ+’`÷ 7¦ƒfÖrÕëô ›—y{1Ó‡pxâíÏÇ&Öo”LJ/•1ÿX§(ªßN™K?!\$BÍ‰3f]Æ\"¶Q÷e¸X,R+(×û 5á8LÚgz@ ˜ÉÄVEº~(ª€…ÃÄ>£ûqfŠ\\§üK A·¥ ÷^ÒÍŸ‹y¥(„Ùíh1ŒPFÊvÃî(Ò·tQ!.øúÃK´¹¸ó”9ÉhR¸Åe4f„½PW\"¹Q±šrÆ\$i˜m}Zßoš¬t·O«ZÙ+3\0\nz>¾< A˜ëü\rãQ (p„/İ ÇÑª›_ĞßòZşñÈÕñò7C4±#«¯ñ°5#¡Id‰ïé1!]1v!6’EˆÆoŒieg³ÎM¡M4¢»Íp>Ì´nïJ˜!JÀCî=\r€ğ/\0¬\r Êàç@Æ ê\rº ´cd–b'àŸ²)ğN~CÆ‚nÚªPn^‘s>´³u¦F–©.(,¯ğcú°ö@¨Z¾>Ù´“uuK´ùy”;“™*£ŠÚúÑ´9!4zÏAÍ/&xèìM\0†nü¨	ºÅ²`@=[®ØiªÁWo°<T‚ß%Uˆk‰Ä•xêDà	\0t	 š@¦\n`";
            break;case "th":$f                     = "à\\! ˆMÀ¹@À0tD\0†Â \nX:&\0§€*à\n8Ş\0­	EÃ30‚/\0ZB (^\0µAàK…2\0ª•À&«‰bâ8¸KGàn‚ŒÄà	I”?J\\£)«Šbå.˜®)ˆ\\ò—S§®\"•¼s\0CÙWJ¤¶_6\\+eV¸6r¸JÃ©5kÒá´]ë³8õÄ@%9«9ªæ4·®fv2° #!˜Ğj65˜Æ:ïi\\ (µzÊ³y¾W eÂj‡\0MLrS«‚{q\0¼×§Ú|\\Iq	¾në[­Rã|¸”é¦›©7;ZÁá4	=j„¸´Ş.óùê°Y7Dƒ	ØÊ 7Ä‘¤ìi6LæS˜€èù£€È0xè4\r/èè0ŒOËÚ¶í‘p—²\0@«-±p¢BP¤,ã»JQpXD1’™«jCb¹2ÂÎ±;èó¤…—\$3€¸\$›Ú4Ã<3«°ô/¬m£Jæ¹î‹®®å†á'ê6¯¹DÚ²Š6ªÉ@»•)[t‡¯ÌÀÁ5ğŒM\$\" #RîË\rto)—Âã»rê|¬¼ˆJdĞ€Õô†ï8Išè8äÚßË(;šE¨S|êï£ŠŠ²¿—“‹3\0\\Ìûbğ§¤Í\$\\#S¢p\\T®•Z¬Ğ®»6‘bw”´Ux»Ök;¤ŸÄ…*\\1êe˜€rz{N¹¶…b®E)\r82ÄXª¦rµ-0±c·kWÕ2Äİ;uœÔ+iš~ğÖtëhòÑJ4`\\;.”ÿ;wÔ°ğÎÉLë|ÄWëÄ¸ñJ\r<ØØ”õz{?»všûXºÉÈ“9PÒ]O\\wİË«+8ğ¹\n”Ã)Æu|í\r'ó±B¬ MŠ»XÎPš!¸ÈÓ¥Dä©û²\\Oï±h­³£rŞ8NEÂ•Esò²ÇéÜ8JgêzÏéìì­Ñü9<£jÍhÓJî®ã;HŒ:ƒcı?!\0æ1Œ#vº\\i•š‰¡„˜¢&QRJàéjşœ£ñÓüY6\nÚºò‰FH*‘üé  ü1’á×âá†8İ+Ã\\Õ¨Ñ¨XÜ±…OÚ¦ûĞÆ4£hÂ¬Ş³Ëİwğ)÷}èÂ“Q›)qÖ.}|[Ø­X4(L%9¬«»e«áxƒÃ\\ß†Ø¼³4á58†W3½ªúh,dî86ƒzPaG¼7†`ÌàeAï‘'šÔ¶–Q¹\n¼ù;àÜA\0u\rÁÌ:†0Æ˜fn€€6ğÎ˜,?ÁÊÎQà † •†ÔxP((`¤âœÕäGQÃ}çQ\0†ÂFdT¸%\$^vÍ‚½-0œ47\\˜—J.*¸Ş\$XÑÎÜ?fĞó˜  r€‚hÛ)¦ŒíVRö;é8ã\$R.Vœ \r!¼7<È†³‘cgñÕ1\nw˜vÉùlQä±M-bz¶:“‚,n.ª2Ş #ƒŒ…`&†æC‘ó“ÁÌ;†ğäÇÃ(x¦†@\\ãË\r3ĞD t\0è‚ğï/ÁpaØ7Pä¥0gá”7L°ğ`Ü{™ ‰»‡#ö%°_A­ô5‚ |Chp?!¶f@xÃ>0çör pŞÇÏø wÁ¬÷†è|æ4œ¨>(óPsWÓ*ª¥1*ÂácÔ|8±0éô5LzvF‡5à¹Ænc\\—¢v‰–¢~Á‰ÛdŠa@\$\0@\n@)yˆQÚ…f×Ï\0(* €*¨È¡QU*åeé+ò¡C|NIóõ;Ö-H½z3ö›H“¸,,,V\\‹\nél.ÇØEÃ’sNÛoé0º‰É\\QÒ'q}Î²°I(y= €2–>|g¸s™“ÁØC©üá˜9ğÚÃ2…ÌÀ@á-z?ÕöQ´OWRX¥…Â¦9ğšƒGrÅŞ”‘p]2š¬4€9Z©ƒ(\$=šÔQÎ´g	p%CifÌtëy„ÍÀ›x¬ YÁ“L=œšÓÏ\\Ûä}@0–a–ƒHgp®cğ{Ï»ËÁR“7Ö>g¦óÚîØ[^ƒ‘î˜íı£ÇF\\LÖ1\\ïˆ¬·pY©-Êèğœ¨P*\\Â E	©ø­ißKp£G·Mp¼–9ÔÄá³¢sN\n,S¸}—¶â–ßÓµ±l\$]2§DÎÉú”3é=Ã°a\r–¬Ä9¦•‰Á&Û\$µ ®EdJMl©®&‘h2ºUŠï¡‡¡¥\\íræW_m(¸/„DÓŞ{ò³i£­L—TP‹¡½%šÖpÍ‡m,FÜù!aêäÇ*5g7êºèöXuzúSìÛbÑÂÿú Ë+\"ÉCU+(§´æ‡\r+·ÓÔ»=:ÔFHOíd ˆÌ\\\"\0­cI]³ºp­ã6)%&1™;!Åİ%íqÕºíÈ+s%4ˆˆ¿¸“\0Ó…»ê¬‹à)†ô@PC°ÁÂmˆò~C‰\\Ü&§8Åv–O-\rıa¶¡‡›RTt˜:Féİ±«Ìn9o2^»-1c1ç‡<?mí˜r3VŞËî–ºDÀòb­XeÓe›î©­Mûhee\nQöXãÚâ)(B»²~ßò\"`Ç…œ²ä¤Ø›N[ŠZÍg_9Uè¼£hÙÎğGËù!9–Í*Ay2;ú9`èœÂxU,Z94U¦N)qY‡£J¡(\nˆ¢ğ æb2¶”·@¸_P@§d±ÔRÅÄ-N­HF(óÁ‡cùê'¸ç¼\\ÛzÒ#t.JÚ¯ÜßA.=dö¹%ÛQp+—ÃêN²ÃúéÛml—!.İ’2ñÈ¨ví^ı‚eè½–;‡8Ì„yé[V5T°YÑê*ö<*?mß}qŞªSuuQË¹ÈRì•;b®DÃ(b¾Êîİù×ÇƒÔÑ¥©ïm‘clYŞá\n4Êl”Ñ;TJdæÀÈÜGø–]ì”Úòz›¿oì¬„ƒ}A\rzNahQBfvhàÅoâ9,9B¶B‹–ª(şÒlÄ÷2Ìæ&ô\"²ôd8COF-ƒÂO°\"¦/@â²;y<cÆy&SJÒIpBN¤Ï­ÓÃPÏæ(8£·¦+c‚}gÓáNAç‚éğfbJhØÍ“°DÄBˆ&!Í×	:·IüĞ…téJŠé†ºVÆŠÉ¦ ¨Œ¾Äf\",†|s…@C„h+eœB²şÄ™„(`ĞÎ!L-	¬0y¦\rÇÎeĞã	ÑcZvNl\0ßFß¤20mÑs¨¨£ÂYÍú.mê ,4B,:{JNâŒbj\rlàS¯Ö.'ã\nçææn˜øP€Ğ.ÔŞåü.eAdXÎÅvĞÑS§ÌGÙ\nÍLà­´ÌßN\0‘bıañm²Ï1ˆòÑx},ÓÑ€é¯Şâ°QêlûPè¬„^³d%cšğ?J\n0Nğ%îôìÌôNĞ&i®şBOÓ¡FAâf¾§´â‹òD¤TëC¸Ïp)ñîÌ.êKôËqıQ\rlÅ±^ßr’ëíBl8ÑúóâéÅî01ˆh#Xaë€ÉÉÏïHSN{#p'l Òî(İ¦¡\rò<Gè<#±ª‡`*šYÑğSe\r†ˆ\nŠëæ&¦›d\$_²HY1ªS2Pç'8à«ÊŠİÄZÃÎ%ií\"Rb¿*ãNoğ ³Ê\0Ë·\r„KPäj3*’\\N‘2d’|`Ñİ#2Mß2ñ`£»ñYp—.³#1 ÑP•Üâs`æJÉ*œ÷\r“7ò:9³\$¬³)&2/²áÒ³Ó	1“\"è¯Qs*åÓrŸ1pƒGMòuSNbŒÄ“Wsè“q5\"7pºâLÌ:#hÖJœkŒ7\$jQOÔˆ%5cÂæëm93€-F	€¤= è0U1*-;¨q<TùSFá²ù6Ñu<Ó¾˜³Ã “3=mñFw&æ\rÍÂšSe=“õ4À>k\nƒàÈ¨7û?èùA’Ÿ@ÀßAÛúRe4KpË%‘-Ê¥£.rI \nƒêîQ>nú_lı<EEN˜ÔXãóñ6†w`+eETi=25ÓK61‹43Úw\0AG®QBCOI4SIo˜DDå7Ì•;*Ìé4\\ôî¥/‹”ÓM/.?3kGEhã¸Ä«\nñŸ5Æ%Lô¶/±¶ª'[@“ÀĞèC±è;ê².¢î¢³#šKtdZ±Öé\$ÓtHÄ‘Şü´¤Ì†Aõ\$06!fì(¯£Ãìi„âáUQmÕëeï6m§²óĞAR­–*ˆŒ Øk \r Æ\rkh Ÿ’ÖTäPÃ%l+\0ŒúÀÚ©>\0Ä¨ú\n ¨ÀZ\0@™€Æäxï&ïcŒí€BQâ‘Ôv:\nòËb}jgP²„\\Ğ‹ªr\" 	µ°ÀòÆî'efiƒŸ&p{H8ÒØE¿MCiPË™U‚Dç]W°ÅX'ğ3H³g/d\$¹§ä_ªv´Äh^íÉDfü@	€Ş˜U³d6F†©L=äAfdjá\0MîÌLW]°HjN¨4o„\n‡Œk,£Ãèé%éVUF 26†™­§M3\\vi#é<lÛÀ¨oø=cÚ=õš±ÀŞ¾†Í®•Çy'j3HDE“0!Có±		L»iURhŒ[UñyÑ—î–³5ìÄ¨àæğª1«oìd.æÇ*q%±+WäÄt&\$ô@h•ºÆ‰:”\0ÒÈM¬¦>\nÀÒ î@¬ Æ ê\r³ÉÏFY%fzÂ\0{9C‚zÍÌÄî)Å’hLXÙ²}:ÊŠÍ2ÄC;e0:m>qĞúUuËèjlÄeq|z1qiê‹pÃh\$šûhÄÅS`†€d=ç}s5l`@>÷AVf˜V\"ºüsté0£²}T´ö:C·}bæk€	\0t	 š@¦\n`";
            break;case "tr":$f                     = "E6šMÂ	Îi=ÁBQpÌÌ 9‚ˆ†ó™äÂ 3°ÖÆã!”äi6`'“yÈ\\\nb,P!Ú= 2ÀÌ‘H°€Äo<N‡XƒbnŸ§Â)Ì…'‰ÅbæÓ)ØÇ:GX‰ùœ@\nFC1 Ôl7ASv*|%4š F`(¨a1\râ	!®Ã^¦2Q×|%˜O3ã¥ĞßvMóÃA†\\ 7\\Îó´ÀÎe9ˆ—3©ÀÈa:sFƒNdépÉğ'˜éĞ«ÖËtFKÅèİ!¦vtÓ	´@e×ñĞ#>¿±ÇœÍæã‘„×ßßÌ ¢œ‚%Ö%M†Ã	»©‚ŸwVã|Ñ²·½Ş¹ë.\n&it2§l4‚ˆæS}0èº’Dê£pê§µîÓ¸ #|\n(ŞîB²^-ã»ˆãJ>²Bb4„hè Â²>ˆ¦NÄŒ#‚|Á–(Â49´/KÀÜ¼\r«Â¢2ªcJÊ:CÏ\"âœ'Š’©#É\"ÌF\rob×£\"lÁ€L³-.[ˆÎXÖƒ\$»Ê×È+péˆ.hÒEÃ<º#Èë¨ ­ƒ0½PX9§ĞcÆ,Ğ\nê=@£`ê©«èòÜ<óO%³O+Öê\n\"d¨ş§TˆÍ­\0Ò5„ŒNX¼c\\J­c\nÂô¼6Ÿ¨rtŒOÉŠO\$R´‡\"ÊõR„˜ë#¯UVĞ`@²Ø4!b”%HélEĞ¸‚5´ïˆŸ,¯*‡oÜ2RådÑÖcÆ—EvŒ9Ì`PØÿ±,X@ò´CxÌ3?pÊ“˜d:|5Ü‹0¨7®u(Ü<„(çŒlÀæ3;Aä3 C˜XÍX€Â3Œ)bY/ 03BaJNıÛ£’=@†)ŠB0R\rN–:…ÁÊ9\r©ãB5¹£“íŒ)8„0ÜªcI¢ñv„®‘‹Â2'É=Gf­ğæ¼LÄH™ƒ ë‹Àè3&,ĞË¤<¨Ä=]ë1’~“‰£p†ü9é,´2„<2Œšx‹(Ì„C@è:Ğ^üè\\0Œ™J<\$£8^˜ôãÃB7 ÎX^S#“.:r‚úâîa|\$£„Ş7à^0‡Ê#2ÿ\r|´Í sD4°£‚=‡&#¦¼[‡¿È­øèç pJ6'ÚåX“Š¯W€¡®¨“1£¤8(	ƒ£øÉ¢ aBŠÎÓ §NÈ¬¦â ®ƒc/Ldy™¥@ÒOÁˆ%\$¬¯`@ÛˆfPq} ² •–²û,­m®‚\0˜Û›(«O‘çô‘!åUmH7p’CÉ\"M\r)hÈ˜UèG\r¥\r”8‡WŞ0r?ª¥Ğ'\0CqeÉzD2àŒ»æ›€ò^@P	áL*\">A˜ü0Å@ª²MLûÆ_dY¥Eò6GŒ¹†D<†t\n»Ò¨\"Íé¾hhIÌQ<guˆ»àŞèÙ6\r!œ5;	-\r\$\\#GìwRÔ”Â½‘›^!¬ĞÂå)âV–‹¸‘Ê\n¥A<'\0ª A\nš„‡C3GD†¬Â\0ˆ‘z¼nçá™PS.åèD¡0\"Ì9‹1æKs™iXÂV‡—¤×	hLå¯·Ì„Ñşl³¹…FÈŸJ¡¬ê@¶t—È'hÂ‡bÙ—ËÙ\r¨…™òraneğ,ÏµÌM<µAr•2‡FDúœÇê³\"–pVäg­ÄPÈ3¦–+ZT´—¢¯JQî)”4´–Rî[”Ü1¤AŸrÄá¬½‘â\$Ø(\\+lbñ‹ÀÚ3…oÑûQ7ªiQ!0!fe	Èì‡Äûy„‚Ä“–òô`%¥!–ÍA^K”ü†K”²:¥è3ú	ÑÓ\ni¸2†3B	mGbÚª£ú¬ºƒy¯‡x\"…µS¬¬P±]«ÓŒCqÎS†j“4lòã%•}Ú`Òªñn8\nm…Kfª-‰|ˆ4¡¡¢¦‚ÕX\n`¬à„ Ò‹ }	3ğA5„ó¸Õq/A-1 äkPUâÍ:”:ÇLŸ’ø/*é}X˜D¼–ÀJ“’í»\"x†šŠ3ƒˆ¸¶0˜gZêÕè67•+½ãîLi˜.!Nî%»âÔï˜§¾¶®ºªËğQ/Õê¿†à_ò9M.‡ÁrãW9ªZ 0¥Ô“¥ó•{°0Ÿ¢íP_Kw‡“ik·w^¬O±N+Á8oãÍ±ä3>>SD îDJI5#\$l®\"hEòY%äÿÈIÂš@÷töB°îCËE=‰•µˆ–OF˜·bü{hÍ»49‘vÔxÎb¨—8Òôk’Ûù&¤ˆ¸€¢l@CÑ|ÕY\$#h^jmŸ™´Åıá‰™HÈ¼\rÌTíà\r-9!]^Âõ´Ô=)¨ì…œX¤ƒ\0ê›°öÓjÔŠaĞ ğÚÌÚÎ<¹ÕAäªpBËIª.‹fÛU‹àB#[l–'¢×™åO`.+,mÜºÕm§Y’Y¢ê­’.OõEÏ¥!5Â\rˆYôù[‘A¥iªñ¦êB‚K•6ÔÒ#ûsxÒš~Põ{`m-Zo-şwÊ½Õ˜cu¯+®»nÉã`¡†*Ë”osgøøŸ_œjapU~8˜ årøÉSã‚Çr+õmªµ’º×îêe·em®\\:«}p¹Yƒ-l¯ç|ìğ3T`­\n¨1ñFÒ©ıÆx£šÒ§¡Ñ²#â:»D³ƒ§³Åiœ&Çiõ”jcï€ŸÜ\nFSØ\nSÌ+âÁ|ÿ™ó¤×i&E>.VÎ¤™×¸ß¹Ó±v7hp™§«|ªÜÛx¤yâ÷DÖ<Äé­¡Ñ%İÏñš¢ç.yÂ·ç™óŞK£z,×ába§ÔDıôÆiG©‡)SzwF!¡MùònQ©õo¾ã£Ÿq#Ä5‡¥L¡¹3Æ¶çÒ‰x‰³ÍúxşZg\r)¥v,¾\"b~‘¡øÿyìRDVmÙxµRª‹d’GÀÃÛø}\r÷«¢§û«»ÉÖÛf{¯PÿÏêó\0´=c¼õK¦Ab|ºÏ6Õ£²ºW/¬ÛpAEoHÖLàhƒº¯zpÃz1.^UG¾œldâÄ¾WjŠ¢<Ã°RÀD¾½)J¨‚D\"¼”‚­cT\ràà\"Ä(3g|ã²»dÔ#‚‚!d´åĞNäjhÆh½dhÂšÓÆœNí~üğ&ßB˜UâX6¢^`@@cş\r€VUbşJÈj@Œ“&ŠGlyâ\n ¨ÀZ~Óg”8ŒK	iÈŞÆb†%À¢ğc\n÷0¾Bãœ\\0xÕ*sŞ¦`	°úÀò[ğ,«ş<m6ÂøÚh[J”W°»PÀ&PÄÛ˜Kk~;¥VZÅ¤\rp,AÚ8@òƒE9oÀƒ¤†H\\I^\"è4Ñ\".§¨¿Âøı†Ägå^¯\nÊiBÈÅEïñ ê\n@P¬~² Ä0~O°­‘¸n¯äÖjòn¦â¨úã\$\"0¶oîÃ~X1ÆiCÉoÙ\nãÊ*zSQ*×Jà¤HŸ#nQá>R-½¥ å D Şµ…ÒD®–FúG)6?ôK@¬\r Êä*\"l\"ú qÔÂ£Dvd’`¢4D\"b8\r7¤î£\\R#’r®„ª¥\rÙÂ/%®-ê4q¾B€†l£@4EK#Ø!“R><€Ö2¨ ?%~#Ó\0Ã>-Îªì";
            break;case "uk":$f                     = "ĞI4‚É ¿h-`­ì&ÑKÁBQpÌÌ 9‚š	Ørñ ¾h-š¸-}[´¹Zõ¢‚•H`Rø¢„˜®dbèÒrbºh d±éZí¢Œ†Gà‹Hü¢ƒ Í\rõMs6@Se+ÈƒE6œJçTd€Jsh\$g\$æG†­fÉj> ”CˆÈf4†ãÌj¾¯SdRêBû\rh¡åSEÕ6\rVG!TI´ÂV±‘ÌĞÔ{Z‚L•¬éòÊ”i%QÏB×ØÜvUXh£ÚÊZ<,›Î¢A„ìeâÈÒv4›¦s)Ì@tåNC	Ót4zÇC	‹¥kK´4\\L+U0\\F½>¿kCß5ˆAø™2@ƒ\$M›à¬4é‹TA¥ŠJ\\GB›Œ4Ã;äõ!/«î¿(+`˜²ê’P¤¿ê{\\’µ\r'¬²TÏSX6…:f¡\$…‚4J2lòæ›2Q4É[y\nš«âhG’ h'L¬BK#Dš#Ïa¯+°d‹¦ŒÛn´¦)J&&(kfB£R3Ø¬ Óz4M2\nËf@¥íZ\rèÑ>É«)ŒF#DŒË1Ä³Q£64ß-¤ş•—;ršFêöO¡ªeŒ_7sJ!?)¬ªV”Ó/Äñ-\rZ-ª‰	«õ¶O²FÜ·uÄŸ]¿\r‹@’6m>Ú¿é*®hU’<î‰Œˆ#@±%àHKjÂ–Ã=m[–¼¡<·Å•A+5l–R5hj€Ñ®„º4H>Ğ³'x75CDVHÕEŠ8[R–³lë<ÁÛhÃ¦Ê!M(}—´Êd…!°\\o@*I`Î¡Ê_I’è#£`Øë¼®’01Œ#t(‰úV„@Wœ4˜KÊfÉ.0ıDßPf‰‡c7ÍR¨³h”¾ŠËÜÚ=5Ê“Ì÷n§©xŒ×aWI5<¨îHP¦ˆ3§lt^Í[È»tÅÛ¶‚kR¥©O±*œ¢B·‘ C*’>×„5‚4JÉ+«.SnÓ:ìV*cc´F—­Qõ2÷F|øƒ ä8.Â99xÌ3\r€Êµ *³Z*\rîXÛ˜!\0ê7c¨Æ1º£˜Í”„`Ş3Â˜Xë]èÂ3Œ0€Aë[a\0Û®ğP9…+[4İÉôŠ…5J\0†)ŠB6@2¸À\\‚#’»£¨Ë¤¶F,¢¸YFˆ‰!(U»FîA‘)\$\$êõH¿†î-Øj`&	ˆ\\´ÜTK fÎ5]JJˆŒyè¹€r	\nªyééò¾Gõ	ˆ,Né„ª5ÆìCQƒ'40‡3¼d=aÜ7‡%ªCÀp\r.°2?0xN#¬Àô€è€:à¼;ÅĞ\\C#Û\rÁ”9èŠÁxe\rÑ¤<ç€C|kL°9@éùæf!¬à’CÒ\r±¨:À^Añf:ÒğõªvĞa\rg 4‡C™Üc\rÁÒ!U:4D¹úEEM¤‰e¬SÕ!şnÍ¨Ğ±‚ ø³?‹A£6¤CÔ Ğ7Çô¤—% €H\n\0¶Yµ¶lå¹Œ\0 ³‚˜W\0 Yû7ÌX9P#“ÈŒ*\">´Jb!ÆX£öºUêƒ!ò™¼N²“›)ı)å­N€,Ë²˜ …Æ”\"§?'Q\rn†õ_”ƒzl!ş¡‰«¨¹D ’x²~e¤Õ°øhQòI%P¨\$öŠ¿!{ü,äğ\$‘pòp\0d\r+TåI`ç¤yá:Î°8‡S«%ƒ0r\rá´Âì¢à@€1¼ª^ué”A:‡¡ˆ¿fy;ÈrÈ£EX‚b¥‘À¼˜<)…F¢[Õj­!£×÷UOUX*„Ï”¦ìĞè-e¤2‰N„²Jú¥™„©)A‘'Mª5ğ%Î(f¹ßHßPA¤3‚\0¦Í\0f:' èE\0Œ…‘\rËT4È‹%¤­™§Tò—‡#PšÍ%ÅÑ£Û;\0¯æÀ‡Tî:ˆ¡²VA‰#!éy?ša0AI>p„pC*‹ŒA˜MĞMG.a™Péí†“Eš~Í^~²­1°ô^áRÒ/#Bˆ’‹ö6³XíE…:Ã€ ˆC0ae2X;ÙM“™MbÄ¸Ï%Ä¨š%âê&Ğ	‚ş›äòí•\nğƒO‡Ü0yí*( —(ÕÖ‚ç.U%§òA>ËtsÒ°&²Ö¡•[wÅ´:\"j Tñ®Å­Š*5xÖ¡¶3Q ˜6¦ú©!Â,­Õ­ä¼„ª0\n)\$ıÁ¢áål)S·\n­\n\n#Mğ`ÜÈ u_åüÁ˜sZ×»„‚ëYgTÙ„¾Yj²	±ºYŸ9\r[’PëŠKóI\r*ô9+râ^½•µdeuNÃHz (!Ó°à÷t˜S§H1àÉˆ‰ĞNÕ_ct-/[—DÚ9/'ESWr+pe\$¦¦D‘ªÃÄ…ÏZWÄğÂX‹M‹(š45(ùmb\$¹êŞ!)¶OŞu¾š4Q­Íëoªûlâšjõx\$³á9`ã ÈÔ„½¡åÔ©£]¨ZO)–ÚvÛ24[[[…S(M¨í‰;ŠrÊæT'eõ¥%¹w\"l¯–Gœ&±ğrªhUTïƒlár-@@ËÓÙKšT®qÉW&äm3-\rÒÍÛ7£D‚\"éo-¢ £Õ°Ü\"OÈ•\$~\0¸òâcÇ2°<Ösvµ!Ç;jÅÇ›t€à¯EåëH—ô­`ÄI<¨éüç¨¡ş¦Ò\nWVåFrï®6Ø¨‹]n‡¥ìrOËvæ¯sNÁÓŠwd#ı¼­‘É/uo=„¨v9k<\"ÜğİÁr÷Ö=Í»ñş\rsø£Z--©§AÜŒôk~©ŠÜ%…(4'éø_©í-ş–%å{Òß=úáSÑp‚q½E°·¼Ñ@ª\nTEà¡UcúÙûñ¥KÕüSäjÙÅ\r>‡*§jáwnÀøš*´ôèÌîÊ ÍÜÃş0‘\r†pğeAègöô¦!H•¸˜So^ë”äNdÇ\$@©ö(0ØÎÌ×N}P,ğ\0Í\nS¸0Õ-s!ªÜt0ò8BpŒT5dkîzcÂÖÑpLs(4Æ°VClŒ™\"T–b»0s’·el®D BjƒÌŞÌ®ôƒb<D+tØòÎxH´…ÍVWƒ\nB@%&p–¼bS…nĞ¶Wæà=0Š2PKÇ!­jŸ¯Ï	ğ_ğnÎÏ-R*a~×Ø×ÆÎ»Â!Ø4gø	¾!kâ%@R»PvÖL`–ŒœsÁæDBí|ÅäÊÈ1!IDÊ\$ÀdTñq0üÑo\$×lrìL‘Hk±LÆåÂ·6ËÎm†îÈJ¡¥Ôƒ*ªET6#DÆî„Lü¦<û£ ËÈVª6,Ï\$èägé è±‡\0±Šñ1UQ’à1–à‘œğ±¤Nñsˆp[ê)FéÑ€©±”1˜`1Ç±£e:†0h­ÑØ—±j=-¦ì‡Ê¶í°21©Q+r!kfñòÚç5!Qÿny PHèÒ\"E!!*ñPĞĞoÈ-Â¼2ı§B”©öıü*âêR…œdñÑx…eà £,?\$6»ïÄûòZàşT‰Î2Ã\r­nY®”Ä2Q\" ›£nXzİiü£*i·(BK%Âº|ğŞ*J™#«k\"q\$\"4Ù&ˆ(ñBd;ä¼×&ÂkŞÚÚgşB±\\éğÔÃw’ê’6Ô’úêò‚‹\$ÒøWíO\$g&ß1Vá²Jke0­Nàğ¶sSÇ¯É30?\"ğY#O8ÜÉäSÓÈ±U r2Ù¯¿4%5Mó2‡á–ÄÈ<U§àNp ÑÉrÕÂdÉ,,OÒ¿1ˆ6øEbhğÒhOœ!Ä/8î\n†Ñc3Ñ6o“£D¸És«#ë3Ì­:Ek:‘Ô»³d>²7.O´?]§_—=“]í;…m61n×bo>Ş+¥—2G)6’>ï÷:fà½ğ™êİ%“š.)²›m´NÍ¸+Ó6°5#aDÛmÉBÓE±Û4´7B”:¯3¿=÷!Ó[?‰ª°?S&Ü4[B¡\0#DdGÓ0dÁ ÕÎ\$qG´/sKG†œât~LtODIì6jâ”‘<ñS2j¤*hò˜D¡4rëâšÔMpÕOw=¤—0æZ3–®}êàe8è‘ßM-Ìs”ê¥¹@´àİ”åMeN¤¸_…é®óOL°ƒ~À(.Ïü>.òIÄğ1¥|Øî·Mi(ÓÆ“Å<ô•0NÓpOµ901-MÏrã‰ıTQµ<­SîŞ†eÊ'€†tÀØr(7Ã+\"*ÏâSïg'É =SG>¢tÄï8Ë6{@ê‡À@I(±€ª\n€Œ pÔiB\0ÎïªåiTQP7Â<qåc/÷.Tè&™5V×•Æ`õÌì\"äîX÷OçrC§Ç	bdªFÔæED]4dÕPNs@	µ²ÀòBadRÃt%\$”Cêÿ’ÂÔq¹IÏäÉEÆ‚r¬ƒîìƒH)¡cXsøË?WĞÓ\$æxÀÂ’UB4Ãbi\$	‹¥D\"Vl²\0Úˆ£;ƒÈt\"ƒêÉªâËğKÒƒCã2CfÁ‘k”^©Ô“Ó¤Õv©Cö\$)­	X¤CVs)Ù:¤Ï!“ÇP_l°lñˆLâ@?cá#-¥li^rFÊnv“k’|‡C2Êô#APVOĞŞ¤2Rİ2àsá 	P¤†ÏÊÒ*³'Q†(­J´×R•QÌ ÔİNx*,°H®ƒ‚a#ºŒ€Ò¿Í\"¥ª\nÀÒ î@¬ Æ ê\r«çn‰¬7ÖŒaM^jÊw†tl >¦şáäˆÔ’ôòèÏÏìCw¦Ã0pË%x?Ğô–£”,˜ÆQ!yw³zÂ4°)¤sUÒ‡Yu©\"‡÷^v-\$Z£¡vĞ°nÑ~&-P 1&³rÌ.Œìó(¯¡~";
            break;case "vi":$f                     = "Bp®”&á†³‚š *ó(J.™„0Q,ĞÃZŒâ¤)vƒ@Tf™\nípj£pº*ÃV˜ÍÃC`á]¦ÌrY<•#\$b\$L2–€@%9¥ÅIÄô×ŒÆÎ“„œ§4Ë…€¡€Äd3\rFÃqÀät9N1 QŠE3Ú¡±hÄj[—J;±ºŠo—ç\nÓ(©Ubµ´da¬®ÆIÂ¾Ri¦Då\0\0A)÷XŞ8@q:g!ÏC½_#yÃÌ¸™6:‚¶ëÑÚ‹Ì.—òŠšíK;×.ğ€¢™„ìi¶n÷»øì¬ÛÀ€ğÁEƒ{\rB\n'î¹»Ší_ÌÁˆ2œkf	v‘ğx”‘Ÿ0»N‚ˆfƒ¬á.4B Â7&c›¼™Bi†Q„k¼<°ÃzP„\n\npLBBšš-KdP¾‰’pS°ÉZ&ÉÁ:’2Ì<€•£ @§ %Kr!˜Ğ£’O½L«.ÌF! bkê]£€#¾ì²ƒ\"HÑ‚P6Âñ’;\$´íŒ®»ÖË\r¹Ü‰1 %+4´eÒ÷0‘›ù#e`Üô9M‚Ş3°ÌCŒ‹Èò:¡@æËŒP‡¡)ÁRÒ„ø¦dªìrP©:ºã[‚_±KÑKMÙS\n’&DÜ°EÑ^”Ì”û\$RòSÎòbpM¤’:ı\r¹Í2H;JÊß¨°%Q­‚ˆêa•2³ºP ‹qvLÙKÚÙEÕiJ›g\nbˆ˜ÃRI)cgÛk`ñ.Ccq>Œ/¤-J¤‚¦\"\\ì=ëv© æ™K¬*˜\rè6°¢Ó5Sjw}_€U¤Õmb895(,¤ğHòLå·\"Ãú]Tl4'„¶+`Ç¢iÄy/Çé3sw±CbĞ#{40C(@7ŒÃ4Â7ªXĞî”#£?	®j‰Œ) è¢¤Š|%o4öœ)XLĞÙ[Á`@‹”o¤®å\\JÆ¨ÍP\0à‹—QÜÊŒ)tSÉÁë­\nô)Ú Ó³m¤	)m¥\nH1>ä5*EXê—HPZi¦FCÀŞ%Â…ƒ(…®ç©©ÚƒÍHåøéÄAw±#tñrBQ±«ÔaF…ÔmTuÌe_%¡\0x¡Ì„C@è:Ğ^ş¨\\0Œƒk 2ApŞ9áxÊ7|CÅ7cO>„Hæ€3Œ£§˜/ŒCd5„Aóô Å\ndéCh<á„.Â@­3=ë°E B\\Ã…Ò¸nI‘­ÔbDÃ(s}.|—B¢]ÈCslˆ5™Ò»Sá /…İc,ñt-ÑP	@š)ó4G„»'0™0’RÚÂrkp¬9µV”§Ñ“¸dE!A¬ºN©‰À€9”‘H»hÊ+ÆÎÔS‹\"t»R~ª\n=‚kPâ'>FÒ¢ÛFNA¿92åI.	\$H<³ãÔTn\rèÈ9¾5GCHs„Á”ÔA”d£q×/eí‡\"høÈ(l\ròÈ à_.ˆù0™’B^É!*%€¼(ğ¦éŞ\\Dåâ„‡b}N£S¤Áÿ‘Ø²N‰á(id[“°èºSC(†éÕg…‚¸å;(ê—á”ğTâ“ÙTAivÁRâŒíYæa,½BVi)Y´QjY¦¶ã‹j{A¨,Å’I’È§CN\"Ä‘ÏäJK P™iËøëœ“à'º\0HH\\õ5ƒEÙDBìF§pˆC0a¬è`Â¨eX	´šKÀĞŸN±Ø8I(ıš–üA&ûDË›ò(Ák#a’_ ¹A˜ LpÓÉÿ\n’ğbÚ`‚‚ŠG¨íN_kõ•Õ¦*€–rÄÌ:)ò¬ÄSµ/U˜Ã“BTˆ¼øtA¥Ò2Ù¦¦œT†PĞ2¾gÇÃux)\n +óÕQHâ&°DP&S¯UãO[sìQŸ¥ËSàK¥ÄÒ_Õ6+P\"À'tí´ÃS¢viëy>0èåh…Ø‰„‡7šõlm™Ç>4`ª¤!K“ÁË0ôÆz5ğÏD@Px&å„ÊéB[ÂBFZ—tA\"·Äâ“3)[ÀPRgÕ•¤CÜºÛé&£Ò‘1–(XJ(&çá4]kKÃcgıÆòî¸oĞ‡´-Ä‚\"Œ’O‘Zl‹w3ïUTí˜·“2k|ÄùvBÇ‚7è-ºf4¼!Y°nLÀ„—7\r€3upñ_6¢.¶	™*-(œ`æÎ™Ği{HÊ7r(ÁæáMvôìı¨å!	VÉE„c5”.êœÉ¡¶Q_hË”ÓeAÈ‚Û¢E(Os	Ìh„\"Lš@›VJ@\$àU—bŸ?¯Éş@6Üa,Ïùº»üäŠÛKA“C*ê&Ù\\U\\Å¿‡2€é5Cl?µfÊ¨ez§¤4ŞU(0¯õîÀf¬úÊÅ,Š9ŒÊâ³\0*v(Ó„JMÄ:<É.º!BÑw!\$/uBFîZDª“:ÁOBèX–Í(ˆ\$Ã H!MĞ†ç²<÷A	2Ykü±l-”q8úwV_=\\ÌSÉ¶¢6ßp“‹uk¨TT^ëqb†•µS½OÊÕK	í,ƒ5;Vt•'ÍÁ-ö—\r›b/Š¼\n]]©).ÑÑ-%­³\$n·2¶mJì‰Ã(ê†x:Òç­ÇBeQéíûUŒ[L<›¯U‰Zr\r'æSÛ•îNm¹µ{éTú—*JoÕ.ñudÄ™Â)P]ïº3r!Õ³tè+†á†ì·37Ş‰ÒßüæG°&x&2hN¹2†ĞO(’R«4JÏ1å7\"j+€¿¹ø¦&„Ğ\$ælÈºvçÜßtNOj<ÌÓ»óPofü	æ¾«ß\"Â—@“3„ Ê«º/Bfà¼}€0,{Ô—£«§'Ğú›‚Pıg¨½L«Ì{Ó€­X¯FXlS››®p’³t!¡7=OÔgtªnlÁ‘¦ÁYçy|&¼ooÑğ¾óÈ¸×õ^cìıEéõÕíûş–lŠrKn¯{	Ææ+ôË<Köæ¾„õO_—ºJjş‡ŸêÔı	ğ]\n(oöªúú*a0V\"0+m\0ä&ö‹àí†¹¾kè—¶¼ïd÷\rç`ÎŒkê¾ïü¶ËäK\n+«°G©ÂäÄu‹L–ÇL±.˜‹è´¦„Ò%PcX0Ë:k°tNæâ¬£²¬é˜ÆNZ=lëƒšb.\$”)æp’!ÅéÈ\$ÊÏHà\"\\	Ä¢bĞ\r(ÅDtë>ÍºşlPÿî\"\$ÂPêÂHAÄå(/Mš4£øF¢\n ¨ÀZ\nPª*ÁNÆLÚäãH›\"@gf¤Æõæ,¤Oş@,¼6dÚ‹l^âA.äPĞşM€6‚\\p&\\¨.,@cfBd”º¥®øëÚ,å®[*(º/€k«´î¢6ßm€%Pb„á.Ä€Õ+Xğn€j˜Š˜'k0ñm€ÔˆvÕãŞ\$ƒp%Æ\r\nÔ\"6ìBóO\"D¡XS¥>VÎÈ½«úÄŠšÖdpB„DÖåä7t<ë5i|¾iÄizÂåv'j6İ«i\n1”Í¼¨DğºJA ÂP€ä\r*N\r ô¥\nÀÒ ï\n*²»árSBÕƒxM*Ë€	g\"p\0ä0­¶á^0«£ü[ãøcŠ\$¨¼Ö¤wîÊ3CFÊy'O\$'ã˜1Ÿ	Ãôh2&hF\"’,L22P#Ÿ#Ë¶…è’Ğj^°£:›\$WÊ~Q…î»¯^öG%(Ú";
            break;case "zh":$f                     = "ä^¨ês•\\šr¤îõâ|%ÌÂ:\$\nr.®„ö2Šr/d²È»[8Ğ S™8€r©!T¡\\¸s¦’I4¢b§r¬ñ•Ğ€Js!Kd²u´eåV¦©ÅDªX,#!˜Ğj6 §:¥t\nr£“îU:.Z²PË‘.…\rVWd^%äŒµ’r¡T²Ô¼*°s#UÕ`QdŞu'c(€ÜoF“±¤Øe3™Nb¦`êp2N™S¡ Ó£:LYñta~¨&6ÛŠ‹•r¶s®Ôükó{¾”òf“qŸw¹ß-œ×ü\n–2‹Œ #*«B!@éL©N…zµĞ¨@F«÷:QQ-ÃÔøE,¹>æK­)u¥¡ZKœåaLŒ–Né.º=ç!tFù6r‘²ĞC”*r“eñÊ^”K!f]¸(r\\§‘E	ÊL½ïiPsºF­ys”àÄ1G)tI¬„Éw\r’­ÙÌF'<} GI\0DœÄYRs0ìI\\–“ñÎRN	&sÄ#lWÄ¡rtä40_KóÆº©EÊ]—R„q)„£ @ùRY%I’t&^ÎRI73BZH‡9i¤åÙÌB(eés—²™ÌG0Ñ\$“*}4ñ‘„0ş§‰qXsJ²¹tğ„\$r‘EB\0NB0ê6\r#dÏ„˜Æ0ÀP¦(‰‡)\"oĞC•UPr”DñÒCÓg1Iœ¥ãÒr6íÌÓ1NR”u[“ÀTDÅå7AóÍt[6¬£Çg1LA4ls¤Y—®\0rë=Ù7—PDoqGrL—&• PØ:Lk#“*7ŒÃ0Øæ­©ÌY•I(ôŠƒ{06ØÈ@:Ã˜ê1Œmæ3Vá\0Ø7Œî`æ4ƒ–\\0Œã˜hó¨@6¹ƒ«VaNDÂÊ@@!ŠbŒ\$å!ÎD‘Šµ¦F¤“qHÉIªêr‘¤«‘ä¹<YV‘Dû)æÃHŞ7Nå¹eï²å¾Ç²ÈÑù{·.âhÂ9µc“3Çc¸Ş9NÃ(ğ8\r8ĞÈàÂÈãC0z\r è8Ax^;öpÂ2iƒpÊ9Ü¸ÎŒ£wx<5yõßUĞäĞ8¾ÙØXD	#hàÏ½èèã|£4~«Z7ÎÍ.–0l¨Ò:3=¾YÛ\rÃ£k¼cŸ‡;—ä)ÒP—gADU¡%|TÛËrZÂ¤r‹‚9 œI‚PW¤4ŠN\0P	@@8\n…Ä{ş=Ä0Dr\"[{T¢!‚\nÔ¤c@¶®\0—d`I©7'\"ùa\\-S’ÓåXò\"å¢¬Ü1\$‰‡–.Jv2ï 9»×Âk!ÔÑ>€ÌƒxmÚ2\$k]è lî&šH äÍ	µ&+4R8 xS\nUy˜²VÁyA+„Å\"Âô *ĞÑîÒ!Tš•XË RÃdû|4ìíÙ±€@ƒHg&\0ÌgŒ©ta*AE€ƒKÒrï¡óÉè±¢hr2à´\nA,É”° DÂ¼\\€ \0U\n …@‹/¦\0D¡0\"Ìcü%á°µEå Gˆ\$å4Ç8±Gâx·‘*/ÑĞ¦aÂ%ûËĞˆC0aVï ;Ù	k\$Zb(Œƒ°.t‡LÀ)ê\"ˆ¨»¢.€–AN.Ïâ?DGÂ\nÌ`åoÈ@ï¸Ìb|b]†°uÜ%ŒDu\\gqP\"Ğ‚Mƒ”G‰ˆtYQÒØ£‘ACDà¬!‚jÁ×Z*‚AB@g¸\\P•EH°[Ó²wE»e%²èrËÃÆ›˜iA”8²u\\o|1š°ÈwhªÊL©«úRYZÙH+•5(¡E\\‰hºM¦@!Öü½Âİˆ¡@Le¸”JiSRÁ\"‰ëpˆ]¬\$SØÖÏd@›DM‘&/”¹ƒ/ka‚Õ6ºğ¤Ô¡O £°JYŠ;¶N¥¢ÒZ'Å)ä®ì“	’x ·à‚}[{r+ÅÖóèƒO±^%\\J¹‚<K¡±b9D˜€ÆH¶ºş…]ÊŸF1¥/Âãn-ÕMÍXqrÅa.÷Šø€ ™*elXáÌ¥Òš.	\"¿¥0’Ax:ú÷ÌNÛ•˜ˆÕ‚&E\0(+†PÅ„-'…2£ Ñ!>°İ°`Š¬J	“ğ-‡(ƒ˜V¨Áv!UBVKôò\nòĞ#“0@£˜\\?cÂ^Ñ|0,”AÖê&w¨Låõöˆ·áÌ&Å£eÉY0»Ş©øur˜®(ù4YQJ‚2åtLYƒ*ä{'™	bšuÈs	1’EØ˜&ÂrˆxwS0ŒK3hrÍÌğ9sÖÏY¯;†ı˜…Ív®F3EÊ•Ÿ3õ)ƒ“zp¡MË@RbœXhl»’(µ\"¢”Y69‹èà“Ë”y8ê-U©4F©¢6I„j“Æ,*µ6­ûÀ:5Â*º)Ú}^­v.Ö¤ËÇ†ÄKŒÂ/×0¹Ù¶+UëDá´ã±,Õê”Q\$#2]~ûuú¿t~!jŒ\nÉbà„îuC¦ÌÛn©ŠÂ9«ı)#ã—r¿‚ävNŞBæüŒ‰JäŠ¡ß¨üŞ•J#-¥Å|ÜL+Dˆa«}êÑ	‘3!«ZxâgÚ¹µñì«µ¬§M«eŠK\\S6~Ñåä£‘°fJK¾ˆæöÏ›«^«ÖÑl-Éi~\"!^ºÅtû\n´Hå¸o\r×,ÔĞVÚªO¯yŠj*ZÖC½•Ê:Ş¼SF3D0E\0aì€µ|ókˆ~Ï§ugj¤ô“ƒ	±=¼sénê\\‚ÊØë!Ös}²è£š§ß¼'9Ú	«Ãø;#É,µÂxœıŸŞwŞèMµşDê™áRÏE¦0\$8ğĞk?aêê}KĞÕúZĞŸ¡7í Ñ7jğ@»¡¸¶Z”ô\"Z(±&Â„£VsƒîĞëJ;yf–]Q›…í×»&0!±@Ø\nãia¬7¹-;gy¬eo€4†f\\ùÍ¨F”\r,:¹	.ù›àU\nƒ€@ïCä9¦Öé_Xæ0NÈ#B8ª4IÃÈ·\$Ø	¯ÈüÏ€aĞ!([‚â,l8Ì‚/¢\0=ƒİ³Ë@ÃêÁ®6áJÎ¡x£!B¡Ò¤:…¢Íà˜\rçf9ƒi*\r§.2£R6\"Z!\0.NˆÅhÊÌz,¦.¬¸zŠÍ\nÚåH÷Îp%0<0 \n…v4C\"2c*@ÊŒ Ş\0è¿\n¶sâZ^PÍM¾ä\$2-¨A2„Å®Ê-\rÍ¬Ş¡Í(œ*à®í­,¶!]	ö@¬@ír ÒÊ´õ\0@\nÀÒ î@¬ Æ ê\r¢0‚¤,Ï¸¯aÌp‚·¾&\$`Ç	Ç	ªBÜ¬PÁÖĞ™	Ê÷¥\\«¦45C*e‘ĞÎ;nTQŞ¤†Übòƒø@	\0t	 š@¦\n`";
            break;case "zh-tw":$f                  = "ä^¨ê%Ó•\\šr¥ÑÎõâ|%ÌÎu:HçB(\\Ë4«‘pŠr –neRQÌ¡D8Ğ S•\nt*.tÒI&”G‘N”ÊAÊ¤S¹V÷:	t%9Sy:\"<r«STâ ,#!˜Ğj61uL\0¼–£“îU:.–²I9“ˆ—BÍæK&]\nDªXç[ªÅ}-,°r¨“ÖûÎöŒ¿‹&ó¨€Ğa;Dãx€àr4&Ã)œÊs3§SÂtÍ\rAĞÂbÒ¥¨E•E1»ŞÔ£Êg:åxç]#0, (§˜4›Œü\r÷ñˆÅG‘qäZ†–¢SÅ )ĞªOLP\0¨ıÎ”«9’«ŠŠ^–—RÜ“îdÊ	ÒKiiZK£Å“ÂK¯j±Èä\$d€©ir_ «Ì»/ÉÊ]g9f]œå©bö…Òä¨*±Ê\\gA2‡¥y­ªî¼ÃeZ.L—iqJ¥–ÁÈ\\§<yGI\\Ä™C2IBWœå!u’2ÚöåqÌJ)!DtÄ´.KÓ ¼Ìî»O%ŠM•ÈxÈCË`aL“%É¤:ZC—¯‘q\$“d1ÊH\nY N(KqÈ]—g1GÂ9{:œÄq%\r‘òI2¨ÅPQ%Ç1pMÏÉâ|ƒB Ê<ÒJ–ğÙL–‘hézNB0ê6\rKnÒ˜Æ0Îp¢&¤‰{I¼§AUµíQ7©dI&ÿ­Ç+xßMùs5ÃPåË5Cbù,KW	w+•d]ÑŞİÑœÄñmx©ebv¥¤a_\$¸1ÊC—ImæsŞ·ºùÆ÷Lu%I’p6ƒ“\$ÊäÍ\rã0Ì6:#+u#G¸eb7³£m˜<„¨Ü9£ÆÓc5†\rƒxÎèacR9fƒÎ0º!šÎãk¢:ÏsîVŒ¾DBhB¦)ÍHŞ5Œ£rüt^§IFºò1y¦áÊKÌ‰ÌD'ÄQ?–aeÓ\")çƒHŞ7)nYIDsô†›AµmŒ>øB”¬ˆš0m€äÏs˜î7S½f8\r9ÈàÂËdc0z\r è8Ax^;÷pÂ2jCpÊ9İ\0Îì¾%i²|Ü„V0äÓx¾ÜYƒXD	#hàÒ\r»(èã|)ºÙ\ró»Uó;&Zşeß\rÃ£uÀ~OÂ—ä,â\"@¢c”J·³àdHÁbĞ—QÌ*\n!†0¹•&.Ğª_ã˜G‹F¶@PI°0BÀè!ˆ`ˆ)0DÀ†°%ZÑ5ÂH[IYæÏø@ˆâ\\L	“[>£˜WUÚŠ\$2‚\0Ÿ”ÎÙ×ªo¢(Pƒ\"C0 ,€2”îg¨sl¯¨Ùš†FC©§V¡˜9ğÚ¼e.lÙ6P@Úb51•ÎctxS\n€}ŠE°Pòªe\n®Ñ2İÓ0€±J*>CPÖÉˆ­ Ä\"'Ã“&eV[„5İ²ğC8 \nk<cFf«ÁP(2ÜÃKÚt\nÔ4Æ¸Ûãr3/\0–ŠA,9ğ†\"4Z”±@(J	á8P T *i‚\0ˆB`E›HE¡Ê#Ä†œ£œ™%!<9DñnVêä]+¶0œD(\n”3†­C°a\r‘¤ó\nv:8£0Ç`O£¸w:\"‚ìöDÈ¸§g‹Âøb!Ú24†¸qÊx!‘c\n’0åè\"Î½-EÂTs‰f*Z ¤è!‰\\\"”1b\0sRÜR8‰ÈVÁ4ùPhq0‚@¸àˆµk…!Ñ±!\n(º©ÕqÈSx\"R@æ™óEŠ!”ÎÃHz (!ÆààÕ+›€4ŒØCÂxÄÉåLI‘3SÙ™éÙ‚ˆr‹Ä,9êæö.ÆØù’9…Ğ\"éÒ‰•Ö.h\\R˜Ó\"eLÃÌ)ÅÃn¨¦—1íj-U¬É!¿á\0(ÒÁæ‡Ñ—V¡ycUì§\"éP ³¶.Åµm/6µzÓŞ`¤‘Kâ”t\n‘DÛxŸ,óV x NÆ<–‰ñncÇ5Óº¢ˆ'„·Ô|çã”^‹Ò'Åü.kEi‹±I9Ø=æ1æEÃ8@¢„@©¸PˆÇÈÇ(€¦ªë`L#\0PL—2ôFĞîÊY%)¤è‹<BN\nqÄ¸s‹a'\0`—?ê‰Q=«*Ø·Éâ(0”IkËyğnDQ­öíÁ³ú9qæ¢ˆ–ˆ7ü”Ò¨ºÉ·t˜Ôal˜€»pMU?ëEÌ	ƒ`âT‘U®®Nb»ã\nO`.ÂlZyğ9Ó¦pé¸Ågôé¡Î,ÅÙÜò1\"ûtv²	¤\\Ò;Üœ>“\\ÚYŠ ™×;lªMÉ\$P		3„KE'QB71\nß<O«=z¨rêÍ>ˆõA-Ó6E0Y;c E”±Ã§WOÂ\"¼)jêÑ #gb#¤˜FXâZnZS–’mqÊÃØŒG;_M.Æ+¸ôNà^Û‰u-~#ÑÕÂ§N;a{Ş~v¾·ŞüíJQ`IüÇ™3,ZîMx.x\r¤à›{up3¤³ûdQ\$r¬à¨C\\Uş¿ò\\-à®€>‚@åUÑ±5x‹q…PTh½Æ©Ş\$ã¢‚¥—3¹„h¾Â#¢àSá)en|˜Ü\\ÌDîY-™¼ºÎèë?hLRûÙéğ{™PNŞßâ“«Ø]K6¦êë½gtÒşÆÄ÷öx¸ÊL[pm)ÚîG¥ıÃ¶ÃÊ.{¥Ì;bêãÜ•À[rğ¤8s\nõCË0Œnäø_ÅÄpMÿi<›ÊâvåÌTD‡”ıÊ×y5Äx;P§ÎÏ¸›…Ş½AÛô½8“â¥æ‰h›ä‹”ln©µE%µ\"fß¢Ÿ,š­‡¼Ç^qˆü{×ìÿº¶(«u|¯…léÿ@=çÉXœ|D’÷ıà^ï±ö´M&İ_^èS\"ÀhµûØ)Ú–À˜p¢£—œ\0¡YÛùœÈHD!ÊL¨HIáF¢.z%ÁbÁç\nÂB.°Êdìç\rÎ¾a1\rö¿\"f:\r€V\0Ò`Ööuj cbf'Ò\r Ìf‰z7@Œ•çÌ§2O4i ª\n€Œ pÊp^:CtÚ†r‹àÁ¨\\#B8¥dœÎ.œ	°_\$’á8¾Í˜0¯È9lÔA«p¡ ´î¥A@\"–‰aÊñ£¸N0Ô	€Şwc¢:pä” Út45Ãl[ªˆ.eàÅ€ÏApH¢ÊÑÍ®z*'\r ÒáPÑL_\0¡Ñ\0î¨Å¡&(DŸp2 ¨XãN2Ã03@Ä¨ì\rààŒ6®GN¹Bô]ğÈ`\r\"âîÎEBª¤ÌQå\"%«ÔQ\\Ùiê±M~±€WeĞâÊ?â,½Hrç4\r*®/Ö\0¬\r Êà\nÀÂ`ê Û\ra\0 fa!,Ö%ú³DÄ½\$~ÒpÚ\"—±a±Š4¤ã¡l Á¦Q£	\0ĞfF5ã4fQŸ1XEâ–SÏNåÌ“cø?Ä\0@	\0t	 š@¦\n`";
            break;}$rg = array();foreach (explode("\n", lzw_decompress($f)) as $X) {
        $rg[] = (strpos($X, "\t") ? explode("\t", $X) : $X);
    }
    return $rg;}if (!$rg) {
    $rg = get_translations($a);
}
if (extension_loaded('pdo')) {
    class
    Min_PDO extends
    PDO
    {
        public $_result, $server_info, $affected_rows, $errno, $error;public function
        __construct() {
            global $c;
            $Fe = array_search("SQL", $c->operators);if ($Fe !== false) {
                unset($c->operators[$Fe]);
            }
        }public function
        dsn($Ib, $V, $_e) {
            try {parent::__construct($Ib, $V, $_e);} catch (Exception $ac) {auth_error($ac->getMessage());}$this->setAttribute(13, array('Min_PDOStatement'));
            $this->server_info = $this->getAttribute(4);}public function
        query($I, $xg = false) {
            $J           = parent::query($I);
            $this->error = "";if (!$J) {
                list(, $this->errno, $this->error) = $this->errorInfo();return
                    false;}$this->store_result($J);return $J;}public function
        multi_query($I) {return $this->_result = $this->query($I);}public function
        store_result($J = null) {
            if (!$J) {$J = $this->_result;if (!$J) {
                return
                    false;
            }
            }if ($J->columnCount()) {$J->num_rows = $J->rowCount();return $J;}$this->affected_rows = $J->rowCount();return
                true;}public function
        next_result() {
            if (!$this->_result) {
                return
                    false;
            }

            $this->_result->_offset = 0;return @$this->_result->nextRowset();}public function
        result($I, $n = 0) {
            $J = $this->query($I);if (!$J) {
                return
                    false;
            }

            $L = $J->fetch();return $L[$n];}}class
    Min_PDOStatement extends
    PDOStatement
    {
        public $_offset = 0, $num_rows;public function
        fetch_assoc() {return $this->fetch(2);}public function
        fetch_row() {return $this->fetch(3);}public function
        fetch_field() {
            $L            = (object) $this->getColumnMeta($this->_offset++);
            $L->orgtable  = $L->table;
            $L->orgname   = $L->name;
            $L->charsetnr = (in_array("blob", (array) $L->flags) ? 63 : 0);return $L;}}}
$Eb = array();class
Min_SQL
{
    public $_conn;public function
    Min_SQL($g) {$this->_conn = $g;}public function
    select($Q, $N, $Z, $u, $he = array(), $_ = 1, $G = 0, $Me = false) {
        global $c, $y;
        $Wc = (count($u) < count($N));
        $I  = $c->selectQueryBuild($N, $Z, $u, $he, $_, $G);if (!$I) {
            $I = "SELECT" . limit(($_GET["page"] != "last" && +$_ && $u && $Wc && $y == "sql" ? "SQL_CALC_FOUND_ROWS " : "") . implode(", ", $N) . "\nFROM " . table($Q), ($Z ? "\nWHERE " . implode(" AND ", $Z) : "") . ($u && $Wc ? "\nGROUP BY " . implode(", ", $u) : "") . ($he ? "\nORDER BY " . implode(", ", $he) : ""), ($_ != "" ? +$_ : null), ($G ? $_ * $G : 0), "\n");
        }

        $Ff = microtime(true);
        $K  = $this->_conn->query($I);if ($Me) {
            echo $c->selectQuery($I, format_time($Ff));
        }
        return $K;}public function
    delete($Q, $Ue, $_ = 0) {
        $I = "FROM " . table($Q);return
        queries("DELETE" . ($_ ? limit1($I, $Ue) : " $I$Ue"));}public function
    update($Q, $P, $Ue, $_ = 0, $wf = "\n") {
        $Kg = array();foreach ($P as $z => $X) {
            $Kg[] = "$z = $X";
        }

        $I = table($Q) . " SET$wf" . implode(",$wf", $Kg);return
        queries("UPDATE" . ($_ ? limit1($I, $Ue) : " $I$Ue"));}public function
    insert($Q, $P) {
        return
        queries("INSERT INTO " . table($Q) . ($P ? " (" . implode(", ", array_keys($P)) . ")\nVALUES (" . implode(", ", $P) . ")" : " DEFAULT VALUES"));}public function
    insertUpdate($Q, $M, $Le) {
        return
            false;}public function
    begin() {
        return
        queries("BEGIN");}public function
    commit() {
        return
        queries("COMMIT");}public function
    rollback() {
        return
        queries("ROLLBACK");}}$Eb = array("server" => "MySQL") + $Eb;if (!defined("DRIVER")) {
    $Ie = array("MySQLi", "MySQL", "PDO_MySQL");
    define("DRIVER", "server");if (extension_loaded("mysqli")) {
        class
        Min_DB extends
        MySQLi
        {
            public $extension = "MySQLi";public function
            Min_DB() {parent::init();}public function
            connect($O, $V, $_e) {
                mysqli_report(MYSQLI_REPORT_OFF);list($Gc, $Ee) = explode(":", $O, 2);
                $K                                              = @$this->real_connect(($O != "" ? $Gc : ini_get("mysqli.default_host")), ($O . $V != "" ? $V : ini_get("mysqli.default_user")), ($O . $V . $_e != "" ? $_e : ini_get("mysqli.default_pw")), null, (is_numeric($Ee) ? $Ee : ini_get("mysqli.default_port")), (!is_numeric($Ee) ? $Ee : null));return $K;}public function
            set_charset($La) {
                if (parent::set_charset($La)) {
                    return
                        true;
                }

                parent::set_charset('utf8');return $this->query("SET NAMES $La");}public function
            result($I, $n = 0) {
                $J = $this->query($I);if (!$J) {
                    return
                        false;
                }

                $L = $J->fetch_array();return $L[$n];}public function
            quote($Jf) {return "'" . $this->escape_string($Jf) . "'";}}} elseif (extension_loaded("mysql") && !(ini_get("sql.safe_mode") && extension_loaded("pdo_mysql"))) {
        class
        Min_DB
        {
            public $extension = "MySQL", $server_info, $affected_rows, $errno, $error, $_link, $_result;public function
            connect($O, $V, $_e) {
                $this->_link = @mysql_connect(($O != "" ? $O : ini_get("mysql.default_host")), ("$O$V" != "" ? $V : ini_get("mysql.default_user")), ("$O$V$_e" != "" ? $_e : ini_get("mysql.default_password")), true, 131072);if ($this->_link) {
                    $this->server_info = mysql_get_server_info($this->_link);
                } else {
                    $this->error = $xoopsDB->error();
                }
                return (bool) $this->_link;}public function
            set_charset($La) {
                if (function_exists('mysql_set_charset')) {if (mysql_set_charset($La, $this->_link)) {
                    return
                        true;
                }

                    mysql_set_charset('utf8', $this->_link);}return $this->query("SET NAMES $La");}public function
            quote($Jf) {return "'" . mysql_real_escape_string($Jf, $this->_link) . "'";}public function
            select_db($qb) {
                return
                mysql_select_db($qb, $this->_link);}public function
            query($I, $xg = false) {
                $J           = @($xg ? mysql_unbuffered_query($I, $this->_link) : mysql_query($I, $this->_link));
                $this->error = "";if (!$J) {
                    $this->errno = mysql_errno($this->_link);
                    $this->error = mysql_error($this->_link);return
                        false;}if ($J === true) {
                    $this->affected_rows = mysql_affected_rows($this->_link);
                    $this->info          = mysql_info($this->_link);return
                        true;}return
                new
                Min_Result($J);}public function
            multi_query($I) {return $this->_result = $this->query($I);}public function
            store_result() {return $this->_result;}public function
            next_result() {
                return
                    false;}public function
            result($I, $n = 0) {
                $J = $this->query($I);if (!$J || !$J->num_rows) {
                    return
                        false;
                }
                return
                mysql_result($J->_result, 0, $n);}}class
        Min_Result
        {
            public $num_rows, $_result, $_offset = 0;public function
            Min_Result($J) {
                $this->_result  = $J;
                $this->num_rows = mysql_num_rows($J);}public function
            fetch_assoc() {
                return
                mysql_fetch_assoc($this->_result);}public function
            fetch_row() {
                return
                mysql_fetch_row($this->_result);}public function
            fetch_field() {
                $K            = mysql_fetch_field($this->_result, $this->_offset++);
                $K->orgtable  = $K->table;
                $K->orgname   = $K->name;
                $K->charsetnr = ($K->blob ? 63 : 0);return $K;}public function
            __destruct() {mysql_free_result($this->_result);}}} elseif (extension_loaded("pdo_mysql")) {
        class
        Min_DB extends
        Min_PDO
        {
            public $extension = "PDO_MySQL";public function
            connect($O, $V, $_e) {
                $this->dsn("mysql:charset=utf8;host=" . str_replace(":", ";unix_socket=", preg_replace('~:(\\d)~', ';port=\\1', $O)), $V, $_e);return
                    true;}public function
            set_charset($La) {$this->query("SET NAMES $La");}public function
            select_db($qb) {return $this->query("USE " . idf_escape($qb));}public function
            query($I, $xg = false) {
                $this->setAttribute(1000, !$xg);return
                parent::query($I, $xg);}}}
    class
    Min_Driver extends
    Min_SQL
    {
        public function
        insert($Q, $P) {return ($P ? parent::insert($Q, $P) : queries("INSERT INTO " . table($Q) . " ()\nVALUES ()"));}public function
        insertUpdate($Q, $M, $Le) {
            $e  = array_keys(reset($M));
            $Je = "INSERT INTO " . table($Q) . " (" . implode(", ", $e) . ") VALUES\n";
            $Kg = array();foreach ($e as $z) {
                $Kg[$z] = "$z = VALUES($z)";
            }

            $Nf = "\nON DUPLICATE KEY UPDATE " . implode(", ", $Kg);
            $Kg = array();
            $od = 0;foreach ($M as $P) {
                $Y = "(" . implode(", ", $P) . ")";if ($Kg && (strlen($Je) + $od + strlen($Y) + strlen($Nf) > 1e6)) {if (!queries($Je . implode(",\n", $Kg) . $Nf)) {
                    return
                        false;
                }

                    $Kg = array();
                    $od = 0;}$Kg[] = $Y;
                $od += strlen($Y) + 2;}return
            queries($Je . implode(",\n", $Kg) . $Nf);}}function
    idf_escape($Kc) {return "`" . str_replace("`", "``", $Kc) . "`";}function
    table($Kc) {
        return
        idf_escape($Kc);}function
    connect() {
        global $c;
        $g = new
            Min_DB;
        $mb = $c->credentials();if ($g->connect($mb[0], $mb[1], $mb[2])) {
            $g->set_charset(charset($g));
            $g->query("SET sql_quote_show_create = 1, autocommit = 1");return $g;}
        $K = $g->error;if (function_exists('iconv') && !is_utf8($K) && strlen($pf = iconv("windows-1250", "utf-8", $K)) > strlen($K)) {
            $K = $pf;
        }
        return $K;}function
    get_databases($qc) {
        global $g;
        $K = get_session("dbs");if ($K === null) {
            $I = ($g->server_info >= 5 ? "SELECT SCHEMA_NAME FROM information_schema.SCHEMATA" : "SHOW DATABASES");
            $K = ($qc ? slow_query($I) : get_vals($I));
            restart_session();
            set_session("dbs", $K);
            stop_session();}
        return $K;}function
    limit($I, $Z, $_, $Sd = 0, $wf = " ") {return " $I$Z" . ($_ !== null ? $wf . "LIMIT $_" . ($Sd ? " OFFSET $Sd" : "") : "");}function
    limit1($I, $Z) {
        return
        limit($I, $Z, 1);}function
    db_collation($k, $Xa) {
        global $g;
        $K = null;
        $i = $g->result("SHOW CREATE DATABASE " . idf_escape($k), 1);if (preg_match('~ COLLATE ([^ ]+)~', $i, $C)) {
            $K = $C[1];
        } elseif (preg_match('~ CHARACTER SET ([^ ]+)~', $i, $C)) {
            $K = $Xa[$C[1]][-1];
        }
        return $K;}function
    engines() {
        $K = array();foreach (get_rows("SHOW ENGINES") as $L) {if (preg_match("~YES|DEFAULT~", $L["Support"])) {
            $K[] = $L["Engine"];
        }
        }
        return $K;}function
    logged_user() {global $g;return $g->result("SELECT USER()");}function
    tables_list() {
        global $g;return
        get_key_vals($g->server_info >= 5 ? "SELECT TABLE_NAME, TABLE_TYPE FROM information_schema.TABLES WHERE TABLE_SCHEMA = DATABASE() ORDER BY TABLE_NAME" : "SHOW TABLES");}function
    count_tables($j) {
        $K = array();foreach ($j as $k) {
            $K[$k] = count(get_vals("SHOW TABLES IN " . idf_escape($k)));
        }
        return $K;}function
    table_status($F = "", $jc = false) {
        global $g;
        $K = array();foreach (get_rows($jc && $g->server_info >= 5 ? "SELECT TABLE_NAME AS Name, Engine, TABLE_COMMENT AS Comment FROM information_schema.TABLES WHERE TABLE_SCHEMA = DATABASE() " . ($F != "" ? "AND TABLE_NAME = " . q($F) : "ORDER BY Name") : "SHOW TABLE STATUS" . ($F != "" ? " LIKE " . q(addcslashes($F, "%_\\")) : "")) as $L) {
            if ($L["Engine"] == "InnoDB") {
                $L["Comment"] = preg_replace('~(?:(.+); )?InnoDB free: .*~', '\\1', $L["Comment"]);
            }
            if (!isset($L["Engine"])) {
                $L["Comment"] = "";
            }
            if ($F != "") {
                return $L;
            }

            $K[$L["Name"]] = $L;}
        return $K;}function
    is_view($R) {return $R["Engine"] === null;}function
    fk_support($R) {
        global $g;return
        preg_match('~InnoDB|IBMDB2I~i', $R["Engine"]) || (preg_match('~NDB~i', $R["Engine"]) && version_compare($g->server_info, '5.6') >= 0);}function
    fields($Q) {
        $K = array();foreach (get_rows("SHOW FULL COLUMNS FROM " . table($Q)) as $L) {preg_match('~^([^( ]+)(?:\\((.+)\\))?( unsigned)?( zerofill)?$~', $L["Type"], $C);
            $K[$L["Field"]] = array("field" => $L["Field"], "full_type" => $L["Type"], "type" => $C[1], "length" => $C[2], "unsigned" => ltrim($C[3] . $C[4]), "default" => ($L["Default"] != "" || preg_match("~char|set~", $C[1]) ? $L["Default"] : null), "null" => ($L["Null"] == "YES"), "auto_increment" => ($L["Extra"] == "auto_increment"), "on_update" => (preg_match('~^on update (.+)~i', $L["Extra"], $C) ? $C[1] : ""), "collation" => $L["Collation"], "privileges" => array_flip(preg_split('~, *~', $L["Privileges"])), "comment" => $L["Comment"], "primary" => ($L["Key"] == "PRI"));}
        return $K;}function
    indexes($Q, $h = null) {
        $K = array();foreach (get_rows("SHOW INDEX FROM " . table($Q), $h) as $L) {$K[$L["Key_name"]]["type"] = ($L["Key_name"] == "PRIMARY" ? "PRIMARY" : ($L["Index_type"] == "FULLTEXT" ? "FULLTEXT" : ($L["Non_unique"] ? "INDEX" : "UNIQUE")));
            $K[$L["Key_name"]]["columns"][]                       = $L["Column_name"];
            $K[$L["Key_name"]]["lengths"][]                       = $L["Sub_part"];
            $K[$L["Key_name"]]["descs"][]                         = null;}
        return $K;}function
    foreign_keys($Q) {
        global $g, $Zd;static $Be = '`(?:[^`]|``)+`';
        $K                        = array();
        $kb                       = $g->result("SHOW CREATE TABLE " . table($Q), 1);if ($kb) {
            preg_match_all("~CONSTRAINT ($Be) FOREIGN KEY ?\\(((?:$Be,? ?)+)\\) REFERENCES ($Be)(?:\\.($Be))? \\(((?:$Be,? ?)+)\\)(?: ON DELETE ($Zd))?(?: ON UPDATE ($Zd))?~", $kb, $vd, PREG_SET_ORDER);foreach ($vd as $C) {
                preg_match_all("~$Be~", $C[2], $Cf);
                preg_match_all("~$Be~", $C[5], $Yf);
                $K[idf_unescape($C[1])] = array("db" => idf_unescape($C[4] != "" ? $C[3] : $C[4]), "table" => idf_unescape($C[4] != "" ? $C[4] : $C[3]), "source" => array_map('idf_unescape', $Cf[0]), "target" => array_map('idf_unescape', $Yf[0]), "on_delete" => ($C[6] ? $C[6] : "RESTRICT"), "on_update" => ($C[7] ? $C[7] : "RESTRICT"));}}
        return $K;}function
    view($F) {
        global $g;return
        array("select" => preg_replace('~^(?:[^`]|`[^`]*`)*\\s+AS\\s+~isU', '', $g->result("SHOW CREATE VIEW " . table($F), 1)));}function
    collations() {
        $K = array();foreach (get_rows("SHOW COLLATION") as $L) {if ($L["Default"]) {
            $K[$L["Charset"]][-1] = $L["Collation"];
        } else {
            $K[$L["Charset"]][] = $L["Collation"];
        }
        }
        ksort($K);foreach ($K as $z => $X) {
            asort($K[$z]);
        }
        return $K;}function
    information_schema($k) {global $g;return ($g->server_info >= 5 && $k == "information_schema") || ($g->server_info >= 5.5 && $k == "performance_schema");}function
    error() {
        global $g;return
        h(preg_replace('~^You have an error.*syntax to use~U', "Syntax error", $g->error));}function
    error_line() {
        global $g;if (preg_match('~ at line ([0-9]+)$~', $g->error, $ef)) {
            return $ef[1] - 1;
        }
    }function
    create_database($k, $Wa) {
        return
        queries("CREATE DATABASE " . idf_escape($k) . ($Wa ? " COLLATE " . q($Wa) : ""));}function
    drop_databases($j) {
        $K = apply_queries("DROP DATABASE", $j, 'idf_escape');
        restart_session();
        set_session("dbs", null);return $K;}function
    rename_database($F, $Wa) {
        $K = false;if (create_database($F, $Wa)) {$ff = array();foreach (tables_list() as $Q => $U) {
            $ff[] = table($Q) . " TO " . idf_escape($F) . "." . table($Q);
        }

            $K = (!$ff || queries("RENAME TABLE " . implode(", ", $ff)));if ($K) {
                queries("DROP DATABASE " . idf_escape(DB));
            }

            restart_session();
            set_session("dbs", null);}
        return $K;}function
    auto_increment() {
        $za = " PRIMARY KEY";if ($_GET["create"] != "" && $_POST["auto_increment_col"]) {foreach (indexes($_GET["create"]) as $w) {if (in_array($_POST["fields"][$_POST["auto_increment_col"]]["orig"], $w["columns"], true)) {$za = "";
            break;}if ($w["type"] == "PRIMARY") {
            $za = " UNIQUE";
        }
        }}
        return " AUTO_INCREMENT$za";}function
    alter_table($Q, $F, $o, $rc, $bb, $Tb, $Wa, $ya, $xe) {
        $sa = array();foreach ($o as $n) {
            $sa[] = ($n[1] ? ($Q != "" ? ($n[0] != "" ? "CHANGE " . idf_escape($n[0]) : "ADD") : " ") . " " . implode($n[1]) . ($Q != "" ? $n[2] : "") : "DROP " . idf_escape($n[0]));
        }

        $sa = array_merge($sa, $rc);
        $Gf = ($bb !== null ? " COMMENT=" . q($bb) : "") . ($Tb ? " ENGINE=" . q($Tb) : "") . ($Wa ? " COLLATE " . q($Wa) : "") . ($ya != "" ? " AUTO_INCREMENT=$ya" : "");if ($Q == "") {
            return
            queries("CREATE TABLE " . table($F) . " (\n" . implode(",\n", $sa) . "\n)$Gf$xe");
        }
        if ($Q != $F) {
            $sa[] = "RENAME TO " . table($F);
        }
        if ($Gf) {
            $sa[] = ltrim($Gf);
        }
        return ($sa || $xe ? queries("ALTER TABLE " . table($Q) . "\n" . implode(",\n", $sa) . $xe) : true);}function
    alter_indexes($Q, $sa) {
        foreach ($sa as $z => $X) {
            $sa[$z] = ($X[2] == "DROP" ? "\nDROP INDEX " . idf_escape($X[1]) : "\nADD $X[0] " . ($X[0] == "PRIMARY" ? "KEY " : "") . ($X[1] != "" ? idf_escape($X[1]) . " " : "") . "(" . implode(", ", $X[2]) . ")");
        }
        return
        queries("ALTER TABLE " . table($Q) . implode(",", $sa));}function
    truncate_tables($S) {
        return
        apply_queries("TRUNCATE TABLE", $S);}function
    drop_views($Og) {
        return
        queries("DROP VIEW " . implode(", ", array_map('table', $Og)));}function
    drop_tables($S) {
        return
        queries("DROP TABLE " . implode(", ", array_map('table', $S)));}function
    move_tables($S, $Og, $Yf) {
        $ff = array();foreach (array_merge($S, $Og) as $Q) {
            $ff[] = table($Q) . " TO " . idf_escape($Yf) . "." . table($Q);
        }
        return
        queries("RENAME TABLE " . implode(", ", $ff));}function
    copy_tables($S, $Og, $Yf) {
        queries("SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO'");foreach ($S as $Q) {
            $F = ($Yf == DB ? table("copy_$Q") : idf_escape($Yf) . "." . table($Q));if (!queries("\nDROP TABLE IF EXISTS $F") || !queries("CREATE TABLE $F LIKE " . table($Q)) || !queries("INSERT INTO $F SELECT * FROM " . table($Q))) {
                return
                    false;
            }
        }
        foreach ($Og as $Q) {
            $F  = ($Yf == DB ? table("copy_$Q") : idf_escape($Yf) . "." . table($Q));
            $Ng = view($Q);if (!queries("DROP VIEW IF EXISTS $F") || !queries("CREATE VIEW $F AS $Ng[select]")) {
                return
                    false;
            }
        }
        return
            true;}function
    trigger($F) {
        if ($F == "") {
            return
            array();
        }

        $M = get_rows("SHOW TRIGGERS WHERE `Trigger` = " . q($F));return
        reset($M);}function
    triggers($Q) {
        $K = array();foreach (get_rows("SHOW TRIGGERS LIKE " . q(addcslashes($Q, "%_\\"))) as $L) {
            $K[$L["Trigger"]] = array($L["Timing"], $L["Event"]);
        }
        return $K;}function
    trigger_options() {
        return
        array("Timing" => array("BEFORE", "AFTER"), "Event" => array("INSERT", "UPDATE", "DELETE"), "Type" => array("FOR EACH ROW"));}function
    routine($F, $U) {
        global $g, $Vb, $Pc, $wg;
        $qa = array("bool", "boolean", "integer", "double precision", "real", "dec", "numeric", "fixed", "national char", "national varchar");
        $vg = "((" . implode("|", array_merge(array_keys($wg), $qa)) . ")\\b(?:\\s*\\(((?:[^'\")]|$Vb)++)\\))?\\s*(zerofill\\s*)?(unsigned(?:\\s+zerofill)?)?)(?:\\s*(?:CHARSET|CHARACTER\\s+SET)\\s*['\"]?([^'\"\\s,]+)['\"]?)?";
        $Be = "\\s*(" . ($U == "FUNCTION" ? "" : $Pc) . ")?\\s*(?:`((?:[^`]|``)*)`\\s*|\\b(\\S+)\\s+)$vg";
        $i  = $g->result("SHOW CREATE $U " . idf_escape($F), 2);
        preg_match("~\\(((?:$Be\\s*,?)*)\\)\\s*" . ($U == "FUNCTION" ? "RETURNS\\s+$vg\\s+" : "") . "(.*)~is", $i, $C);
        $o = array();
        preg_match_all("~$Be\\s*,?~is", $C[1], $vd, PREG_SET_ORDER);foreach ($vd as $se) {
            $F   = str_replace("``", "`", $se[2]) . $se[3];
            $o[] = array("field" => $F, "type" => strtolower($se[5]), "length" => preg_replace_callback("~$Vb~s", 'normalize_enum', $se[6]), "unsigned" => strtolower(preg_replace('~\\s+~', ' ', trim("$se[8] $se[7]"))), "null" => 1, "full_type" => $se[4], "inout" => strtoupper($se[1]), "collation" => strtolower($se[9]));}if ($U != "FUNCTION") {
            return
            array("fields" => $o, "definition" => $C[11]);
        }
        return
        array("fields" => $o, "returns" => array("type" => $C[12], "length" => $C[13], "unsigned" => $C[15], "collation" => $C[16]), "definition" => $C[17], "language" => "SQL");}function
    routines() {
        return
        get_rows("SELECT ROUTINE_NAME, ROUTINE_TYPE, DTD_IDENTIFIER FROM information_schema.ROUTINES WHERE ROUTINE_SCHEMA = " . q(DB));}function
    routine_languages() {
        return
        array();}function
    last_id() {global $g;return $g->result("SELECT LAST_INSERT_ID()");}function
    explain($g, $I) {return $g->query("EXPLAIN " . ($g->server_info >= 5.1 ? "PARTITIONS " : "") . $I);}function
    found_rows($R, $Z) {return ($Z || $R["Engine"] != "InnoDB" ? null : $R["Rows"]);}function
    types() {
        return
        array();}function
    schemas() {
        return
        array();}function
    get_schema() {return "";}function
    set_schema($rf) {
        return
            true;}function
    create_sql($Q, $ya) {
        global $g;
        $K = $g->result("SHOW CREATE TABLE " . table($Q), 1);if (!$ya) {
            $K = preg_replace('~ AUTO_INCREMENT=\\d+~', '', $K);
        }
        return $K;}function
    truncate_sql($Q) {return "TRUNCATE " . table($Q);}function
    use_sql($qb) {return "USE " . idf_escape($qb);}function
    trigger_sql($Q, $Lf) {
        $K = "";foreach (get_rows("SHOW TRIGGERS LIKE " . q(addcslashes($Q, "%_\\")), null, "-- ") as $L) {
            $K .= "\n" . ($Lf == 'CREATE+ALTER' ? "DROP TRIGGER IF EXISTS " . idf_escape($L["Trigger"]) . ";;\n" : "") . "CREATE TRIGGER " . idf_escape($L["Trigger"]) . " $L[Timing] $L[Event] ON " . table($L["Table"]) . " FOR EACH ROW\n$L[Statement];;\n";
        }
        return $K;}function
    show_variables() {
        return
        get_key_vals("SHOW VARIABLES");}function
    process_list() {
        return
        get_rows("SHOW FULL PROCESSLIST");}function
    show_status() {
        return
        get_key_vals("SHOW STATUS");}function
    convert_field($n) {
        if (preg_match("~binary~", $n["type"])) {
            return "HEX(" . idf_escape($n["field"]) . ")";
        }
        if ($n["type"] == "bit") {
            return "BIN(" . idf_escape($n["field"]) . " + 0)";
        }
        if (preg_match("~geometry|point|linestring|polygon~", $n["type"])) {
            return "AsWKT(" . idf_escape($n["field"]) . ")";
        }
    }function
    unconvert_field($n, $K) {
        if (preg_match("~binary~", $n["type"])) {
            $K = "UNHEX($K)";
        }
        if ($n["type"] == "bit") {
            $K = "CONV($K, 2, 10) + 0";
        }
        if (preg_match("~geometry|point|linestring|polygon~", $n["type"])) {
            $K = "GeomFromText($K)";
        }
        return $K;}function
    support($kc) {global $g;return !preg_match("~scheme|sequence|type|view_trigger" . ($g->server_info < 5.1 ? "|event|partitioning" . ($g->server_info < 5 ? "|routine|trigger|view" : "") : "") . "~", $kc);}$y = "sql";
    $wg                                                                                                                                                                                                           = array();
    $Kf                                                                                                                                                                                                           = array();foreach (array(lang(21) => array("tinyint" => 3, "smallint" => 5, "mediumint" => 8, "int" => 10, "bigint" => 20, "decimal" => 66, "float" => 12, "double" => 21), lang(22) => array("date" => 10, "datetime" => 19, "timestamp" => 19, "time" => 10, "year" => 4), lang(23) => array("char" => 255, "varchar" => 65535, "tinytext" => 255, "text" => 65535, "mediumtext" => 16777215, "longtext" => 4294967295), lang(24) => array("enum" => 65535, "set" => 64), lang(25) => array("bit" => 20, "binary" => 255, "varbinary" => 65535, "tinyblob" => 255, "blob" => 65535, "mediumblob" => 16777215, "longblob" => 4294967295), lang(26) => array("geometry" => 0, "point" => 0, "linestring" => 0, "polygon" => 0, "multipoint" => 0, "multilinestring" => 0, "multipolygon" => 0, "geometrycollection" => 0)) as $z => $X) {
        $wg += $X;
        $Kf[$z] = array_keys($X);}
    $Cg = array("unsigned", "zerofill", "unsigned zerofill");
    $de = array("=", "<", ">", "<=", ">=", "!=", "LIKE", "LIKE %%", "REGEXP", "IN", "IS NULL", "NOT LIKE", "NOT REGEXP", "NOT IN", "IS NOT NULL", "SQL");
    $xc = array("char_length", "date", "from_unixtime", "lower", "round", "sec_to_time", "time_to_sec", "upper");
    $_c = array("avg", "count", "count distinct", "group_concat", "max", "min", "sum");
    $Lb = array(array("char" => "md5/sha1/password/encrypt/uuid", "binary" => "md5/sha1", "date|time" => "now"), array("(^|[^o])int|float|double|decimal" => "+/-", "date" => "+ interval/- interval", "time" => "addtime/subtime", "char|text" => "concat"));}
define("SERVER", $_GET[DRIVER]);
define("DB", $_GET["db"]);
define("ME", preg_replace('~^[^?]*/([^?]*).*~', '\\1', $_SERVER["REQUEST_URI"]) . '?' . (sid() ? SID . '&' : '') . (SERVER !== null ? DRIVER . "=" . urlencode(SERVER) . '&' : '') . (isset($_GET["username"]) ? "username=" . urlencode($_GET["username"]) . '&' : '') . (DB != "" ? 'db=' . urlencode(DB) . '&' . (isset($_GET["ns"]) ? "ns=" . urlencode($_GET["ns"]) . "&" : "") : ''));
$fa = "4.2.1";class
Adminer
{
    public $operators;public function
    name() {return "<a href='http://www.adminer.org/' target='_blank' id='h1'>Adminer</a>";}public function
    credentials() {
        return
        array(SERVER, $_GET["username"], get_password());}public function
    permanentLogin($i = false) {
        return
        password_file($i);}public function
    bruteForceKey() {return $_SERVER["REMOTE_ADDR"];}public function
    database() {
        return
            DB;}public function
    databases($qc = true) {
        return
        get_databases($qc);}public function
    schemas() {
        return
        schemas();}public function
    queryTimeout() {
        return
            5;}public function
    headers() {
        return
            true;}public function
    head() {
        return
            true;}public function
    loginForm() {
        global $Eb;
        echo '<table cellspacing="0">
<tr><th>', lang(27), '<td>', html_select("auth[driver]", $Eb, DRIVER, "loginDriver(this);"), '<tr><th>', lang(28), '<td><input name="auth[server]" value="', h(SERVER), '" title="hostname[:port]" placeholder="localhost" autocapitalize="off">
<tr><th>', lang(29), '<td><input name="auth[username]" id="username" value="', h($_GET["username"]), '" autocapitalize="off">
<tr><th>', lang(30), '<td><input type="password" name="auth[password]">
<tr><th>', lang(31), '<td><input name="auth[db]" value="', h($_GET["db"]);?>" autocapitalize="off">
</table>
<script type="text/javascript">
var username = document.getElementById('username');
focus(username);
username.form['auth[driver]'].onchange();
</script>
<?php

        echo "<p><input type='submit' value='" . lang(32) . "'>\n", checkbox("auth[permanent]", 1, $_COOKIE["adminer_permanent"], lang(33)) . "\n";}public function
    login($td, $_e) {
        return
            true;}public function
    tableName($Rf) {
        return
        h($Rf["Name"]);}public function
    fieldName($n, $he = 0) {return '<span title="' . h($n["full_type"]) . '">' . h($n["field"]) . '</span>';}public function
    selectLinks($Rf, $P = "") {
        echo '<p class="links">';
        $sd = array("select" => lang(34));if (support("table") || support("indexes")) {
            $sd["table"] = lang(35);
        }
        if (support("table")) {
            if (is_view($Rf)) {
                $sd["view"] = lang(36);
            } else {
                $sd["create"] = lang(37);
            }
        }if ($P !== null) {
            $sd["edit"] = lang(38);
        }
        foreach ($sd as $z => $X) {
            echo " <a href='" . h(ME) . "$z=" . urlencode($Rf["Name"]) . ($z == "edit" ? $P : "") . "'" . bold(isset($_GET[$z])) . ">$X</a>";
        }

        echo "\n";}public function
    foreignKeys($Q) {
        return
        foreign_keys($Q);}public function
    backwardKeys($Q, $Qf) {
        return
        array();}public function
    backwardKeysPrint($Aa, $L) {}public function
    selectQuery($I, $eg) {global $y;return "<p><code class='jush-$y'>" . h(str_replace("\n", " ", $I)) . "</code> <span class='time'>($eg)</span>" . (support("sql") ? " <a href='" . h(ME) . "sql=" . urlencode($I) . "'>" . lang(10) . "</a>" : "") . "</p>";}public function
    rowDescription($Q) {return "";}public function
    rowDescriptions($M, $sc) {return $M;}public function
    selectLink($X, $n) {}public function
    selectVal($X, $A, $n, $oe) {
        $K = ($X === null ? "<i>NULL</i>" : (preg_match("~char|binary~", $n["type"]) && !preg_match("~var~", $n["type"]) ? "<code>$X</code>" : $X));if (preg_match('~blob|bytea|raw|file~', $n["type"]) && !is_utf8($X)) {
            $K = lang(39, strlen($oe));
        }
        return ($A ? "<a href='" . h($A) . "'" . (is_url($A) ? " rel='noreferrer'" : "") . ">$K</a>" : $K);}public function
    editVal($X, $n) {return $X;}public function
    selectColumnsPrint($N, $e) {
        global $xc, $_c;
        print_fieldset("select", lang(40), $N);
        $v     = 0;
        $N[""] = array();foreach ($N as $z => $X) {
            $X = $_GET["columns"][$z];
            $d = select_input(" name='columns[$v][col]' onchange='" . ($z !== "" ? "selectFieldChange(this.form)" : "selectAddRow(this)") . ";'", $e, $X["col"]);
            echo "<div>" . ($xc || $_c ? "<select name='columns[$v][fun]' onchange='helpClose();" . ($z !== "" ? "" : " this.nextSibling.nextSibling.onchange();") . "'" . on_help("getTarget(event).value && getTarget(event).value.replace(/ |\$/, '(') + ')'", 1) . ">" . optionlist(array(-1 => "") + array_filter(array(lang(41) => $xc, lang(42) => $_c)), $X["fun"]) . "</select>" . "($d)" : $d) . "</div>\n";
            $v++;}echo "</div></fieldset>\n";}public function
    selectSearchPrint($Z, $e, $x) {
        print_fieldset("search", lang(43), $Z);foreach ($x as $v => $w) {if ($w["type"] == "FULLTEXT") {echo "(<i>" . implode("</i>, <i>", array_map('h', $w["columns"])) . "</i>) AGAINST", " <input type='search' name='fulltext[$v]' value='" . h($_GET["fulltext"][$v]) . "' onchange='selectFieldChange(this.form);'>", checkbox("boolean[$v]", 1, isset($_GET["boolean"][$v]), "BOOL"), "<br>\n";}}$_GET["where"] = (array) $_GET["where"];
        reset($_GET["where"]);
        $Ka = "this.nextSibling.onchange();";for ($v = 0; $v <= count($_GET["where"]); $v++) {list(, $X) = each($_GET["where"]);if (!$X || ("$X[col]$X[val]" != "" && in_array($X["op"], $this->operators))) {echo "<div>" . select_input(" name='where[$v][col]' onchange='$Ka'", $e, $X["col"], "(" . lang(44) . ")"), html_select("where[$v][op]", $this->operators, $X["op"], $Ka), "<input type='search' name='where[$v][val]' value='" . h($X["val"]) . "' onchange='" . ($X ? "selectFieldChange(this.form)" : "selectAddRow(this)") . ";' onkeydown='selectSearchKeydown(this, event);' onsearch='selectSearchSearch(this);'></div>\n";}}echo "</div></fieldset>\n";}public function
    selectOrderPrint($he, $e, $x) {
        print_fieldset("sort", lang(45), $he);
        $v = 0;foreach ((array) $_GET["order"] as $z => $X) {
            if ($X != "") {echo "<div>" . select_input(" name='order[$v]' onchange='selectFieldChange(this.form);'", $e, $X), checkbox("desc[$v]", 1, isset($_GET["desc"][$z]), lang(46)) . "</div>\n";
                $v++;}}echo "<div>" . select_input(" name='order[$v]' onchange='selectAddRow(this);'", $e), checkbox("desc[$v]", 1, false, lang(46)) . "</div>\n", "</div></fieldset>\n";}public function
    selectLimitPrint($_) {
        echo "<fieldset><legend>" . lang(47) . "</legend><div>";
        echo "<input type='number' name='limit' class='size' value='" . h($_) . "' onchange='selectFieldChange(this.form);'>", "</div></fieldset>\n";}public function
    selectLengthPrint($dg) {if ($dg !== null) {echo "<fieldset><legend>" . lang(48) . "</legend><div>", "<input type='number' name='text_length' class='size' value='" . h($dg) . "'>", "</div></fieldset>\n";}}public function
    selectActionPrint($x) {
        echo "<fieldset><legend>" . lang(49) . "</legend><div>", "<input type='submit' value='" . lang(40) . "'>", " <span id='noindex' title='" . lang(50) . "'></span>", "<script type='text/javascript'>\n", "var indexColumns = ";
        $e = array();foreach ($x as $w) {
            if ($w["type"] != "FULLTEXT") {
                $e[reset($w["columns"])] = 1;
            }
        }$e[""] = 1;foreach ($e as $z => $X) {
            json_row($z);
        }

        echo ";\n", "selectFieldChange(document.getElementById('form'));\n", "</script>\n", "</div></fieldset>\n";}public function
    selectCommandPrint() {return !information_schema(DB);}public function
    selectImportPrint() {return !information_schema(DB);}public function
    selectEmailPrint($Qb, $e) {}public function
    selectColumnsProcess($e, $x) {
        global $xc, $_c;
        $N = array();
        $u = array();foreach ((array) $_GET["columns"] as $z => $X) {
            if ($X["fun"] == "count" || ($X["col"] != "" && (!$X["fun"] || in_array($X["fun"], $xc) || in_array($X["fun"], $_c)))) {$N[$z] = apply_sql_function($X["fun"], ($X["col"] != "" ? idf_escape($X["col"]) : "*"));if (!in_array($X["fun"], $_c)) {
                $u[] = $N[$z];
            }
            }}return
        array($N, $u);}public function
    selectSearchProcess($o, $x) {
        global $g, $y;
        $K = array();foreach ($x as $v => $w) {
            if ($w["type"] == "FULLTEXT" && $_GET["fulltext"][$v] != "") {
                $K[] = "MATCH (" . implode(", ", array_map('idf_escape', $w["columns"])) . ") AGAINST (" . q($_GET["fulltext"][$v]) . (isset($_GET["boolean"][$v]) ? " IN BOOLEAN MODE" : "") . ")";
            }
        }foreach ((array) $_GET["where"] as $X) {
            if ("$X[col]$X[val]" != "" && in_array($X["op"], $this->operators)) {$db = " $X[op]";if (preg_match('~IN$~', $X["op"])) {$Mc = process_length($X["val"]);
                $db .= " " . ($Mc != "" ? $Mc : "(NULL)");} elseif ($X["op"] == "SQL") {
                $db = " $X[val]";
            } elseif ($X["op"] == "LIKE %%") {
                $db = " LIKE " . $this->processInput($o[$X["col"]], "%$X[val]%");
            } elseif ($X["op"] == "ILIKE %%") {
                $db = " ILIKE " . $this->processInput($o[$X["col"]], "%$X[val]%");
            } elseif (!preg_match('~NULL$~', $X["op"])) {
                $db .= " " . $this->processInput($o[$X["col"]], $X["val"]);
            }
                if ($X["col"] != "") {
                    $K[] = idf_escape($X["col"]) . $db;
                } else {
                    $Ya = array();foreach ($o as $F => $n) {
                        $Yc = preg_match('~char|text|enum|set~', $n["type"]);if ((is_numeric($X["val"]) || !preg_match('~(^|[^o])int|float|double|decimal|bit~', $n["type"])) && (!preg_match("~[\x80-\xFF]~", $X["val"]) || $Yc)) {$F = idf_escape($F);
                            $Ya[]                         = ($y == "sql" && $Yc && !preg_match("~^utf8_~", $n["collation"]) ? "CONVERT($F USING " . charset($g) . ")" : $F);}}$K[] = ($Ya ? "(" . implode("$db OR ", $Ya) . "$db)" : "0");}}}return $K;}public function
    selectOrderProcess($o, $x) {
        $K = array();foreach ((array) $_GET["order"] as $z => $X) {if ($X != "") {
            $K[] = (preg_match('~^((COUNT\\(DISTINCT |[A-Z0-9_]+\\()(`(?:[^`]|``)+`|"(?:[^"]|"")+")\\)|COUNT\\(\\*\\))$~', $X) ? $X : idf_escape($X)) . (isset($_GET["desc"][$z]) ? " DESC" : "");
        }
        }return $K;}public function
    selectLimitProcess() {return (isset($_GET["limit"]) ? $_GET["limit"] : "50");}public function
    selectLengthProcess() {return (isset($_GET["text_length"]) ? $_GET["text_length"] : "100");}public function
    selectEmailProcess($Z, $sc) {
        return
            false;}public function
    selectQueryBuild($N, $Z, $u, $he, $_, $G) {return "";}public function
    messageQuery($I, $eg) {
        global $y;
        restart_session();
        $Ec = &get_session("queries");
        $Ic = "sql-" . count($Ec[$_GET["db"]]);if (strlen($I) > 1e6) {
            $I = preg_replace('~[\x80-\xFF]+$~', '', substr($I, 0, 1e6)) . "\n...";
        }

        $Ec[$_GET["db"]][] = array($I, time(), $eg);return " <span class='time'>" . @date("H:i:s") . "</span> <a href='#$Ic' onclick=\"return !toggle('$Ic');\">" . lang(51) . "</a>" . "<div id='$Ic' class='hidden'><pre><code class='jush-$y'>" . shorten_utf8($I, 1000) . '</code></pre>' . ($eg ? " <span class='time'>($eg)</span>" : '') . (support("sql") ? '<p><a href="' . h(str_replace("db=" . urlencode(DB), "db=" . urlencode($_GET["db"]), ME) . 'sql=&history=' . (count($Ec[$_GET["db"]]) - 1)) . '">' . lang(10) . '</a>' : '') . '</div>';}public function
    editFunctions($n) {
        global $Lb;
        $K = ($n["null"] ? "NULL/" : "");foreach ($Lb as $z => $xc) {
            if (!$z || (!isset($_GET["call"]) && (isset($_GET["select"]) || where($_GET)))) {foreach ($xc as $Be => $X) {
                if (!$Be || preg_match("~$Be~", $n["type"])) {
                    $K .= "/$X";
                }
            }if ($z && !preg_match('~set|blob|bytea|raw|file~', $n["type"])) {
                $K .= "/SQL";
            }
            }}if ($n["auto_increment"] && !isset($_GET["select"]) && !where($_GET)) {
            $K = lang(52);
        }
        return
        explode("/", $K);}public function
    editInput($Q, $n, $wa, $Y) {
        if ($n["type"] == "enum") {
            return (isset($_GET["select"]) ? "<label><input type='radio'$wa value='-1' checked><i>" . lang(8) . "</i></label> " : "") . ($n["null"] ? "<label><input type='radio'$wa value=''" . ($Y !== null || isset($_GET["select"]) ? "" : " checked") . "><i>NULL</i></label> " : "") . enum_input("radio", $wa, $n, $Y, 0);
        }
        return "";}public function
    processInput($n, $Y, $s = "") {
        if ($s == "SQL") {
            return $Y;
        }

        $F = $n["field"];
        $K = q($Y);if (preg_match('~^(now|getdate|uuid)$~', $s)) {
            $K = "$s()";
        } elseif (preg_match('~^current_(date|timestamp)$~', $s)) {
            $K = $s;
        } elseif (preg_match('~^([+-]|\\|\\|)$~', $s)) {
            $K = idf_escape($F) . " $s $K";
        } elseif (preg_match('~^[+-] interval$~', $s)) {
            $K = idf_escape($F) . " $s " . (preg_match("~^(\\d+|'[0-9.: -]') [A-Z_]+$~i", $Y) ? $Y : $K);
        } elseif (preg_match('~^(addtime|subtime|concat)$~', $s)) {
            $K = "$s(" . idf_escape($F) . ", $K)";
        } elseif (preg_match('~^(md5|sha1|password|encrypt)$~', $s)) {
            $K = "$s($K)";
        }
        return
        unconvert_field($n, $K);}public function
    dumpOutput() {
        $K = array('text' => lang(53), 'file' => lang(54));if (function_exists('gzencode')) {
            $K['gz'] = 'gzip';
        }
        return $K;}public function
    dumpFormat() {
        return
        array('sql' => 'SQL', 'csv' => 'CSV,', 'csv;' => 'CSV;', 'tsv' => 'TSV');}public function
    dumpDatabase($k) {}public function
    dumpTable($Q, $Lf, $Zc = 0) {
        if ($_POST["format"] != "sql") {echo "\xef\xbb\xbf";if ($Lf) {
            dump_csv(array_keys(fields($Q)));
        }
        } else {
            if ($Zc == 2) {$o = array();foreach (fields($Q) as $F => $n) {
                $o[] = idf_escape($F) . " $n[full_type]";
            }

                $i = "CREATE TABLE " . table($Q) . " (" . implode(", ", $o) . ")";} else {
                $i = create_sql($Q, $_POST["auto_increment"]);
            }

            set_utf8mb4($i);if ($Lf && $i) {
                if ($Lf == "DROP+CREATE" || $Zc == 1) {
                    echo "DROP " . ($Zc == 2 ? "VIEW" : "TABLE") . " IF EXISTS " . table($Q) . ";\n";
                }
                if ($Zc == 1) {
                    $i = remove_definer($i);
                }

                echo "$i;\n\n";}}}public function
    dumpData($Q, $Lf, $I) {
        global $g, $y;
        $xd = ($y == "sqlite" ? 0 : 1048576);if ($Lf) {
            if ($_POST["format"] == "sql") {if ($Lf == "TRUNCATE+INSERT") {
                echo
                truncate_sql($Q) . ";\n";
            }

                $o = fields($Q);}$J = $g->query($I, 1);if ($J) {
                $Rc = "";
                $Ia = "";
                $cd = array();
                $Nf = "";
                $lc = ($Q != '' ? 'fetch_assoc' : 'fetch_row');while ($L = $J->$lc()) {
                    if (!$cd) {$Kg = array();foreach ($L as $X) {
                        $n    = $J->fetch_field();
                        $cd[] = $n->name;
                        $z    = idf_escape($n->name);
                        $Kg[] = "$z = VALUES($z)";}$Nf = ($Lf == "INSERT+UPDATE" ? "\nON DUPLICATE KEY UPDATE " . implode(", ", $Kg) : "") . ";\n";}if ($_POST["format"] != "sql") {
                        if ($Lf == "table") {dump_csv($cd);
                            $Lf = "INSERT";}dump_csv($L);} else {
                        if (!$Rc) {
                            $Rc = "INSERT INTO " . table($Q) . " (" . implode(", ", array_map('idf_escape', $cd)) . ") VALUES";
                        }
                        foreach ($L as $z => $X) {
                            $n     = $o[$z];
                            $L[$z] = ($X !== null ? unconvert_field($n, preg_match('~(^|[^o])int|float|double|decimal~', $n["type"]) && $X != '' ? $X : q($X)) : "NULL");}$pf = ($xd ? "\n" : " ") . "(" . implode(",\t", $L) . ")";if (!$Ia) {
                            $Ia = $Rc . $pf;
                        } elseif (strlen($Ia) + 4 + strlen($pf) + strlen($Nf) < $xd) {
                            $Ia .= ",$pf";
                        } else {
                            echo $Ia . $Nf;
                            $Ia = $Rc . $pf;}}}if ($Ia) {
                    echo $Ia . $Nf;
                }
            } elseif ($_POST["format"] == "sql") {
                echo "-- " . str_replace("\n", " ", $g->error) . "\n";
            }
        }}public function
    dumpFilename($Jc) {
        return
        friendly_url($Jc != "" ? $Jc : (SERVER != "" ? SERVER : "localhost"));}public function
    dumpHeaders($Jc, $Id = false) {
        $qe = $_POST["output"];
        $gc = (preg_match('~sql~', $_POST["format"]) ? "sql" : ($Id ? "tar" : "csv"));
        header("Content-Type: " . ($qe == "gz" ? "application/x-gzip" : ($gc == "tar" ? "application/x-tar" : ($gc == "sql" || $qe != "file" ? "text/plain" : "text/csv") . "; charset=utf-8")));if ($qe == "gz") {
            ob_start('ob_gzencode', 1e6);
        }
        return $gc;}public function
    homepage() {
        echo '<p class="links">' . ($_GET["ns"] == "" && support("database") ? '<a href="' . h(ME) . 'database=">' . lang(55) . "</a>\n" : ""), (support("scheme") ? "<a href='" . h(ME) . "scheme='>" . ($_GET["ns"] != "" ? lang(56) : lang(57)) . "</a>\n" : ""), ($_GET["ns"] !== "" ? '<a href="' . h(ME) . 'schema=">' . lang(58) . "</a>\n" : ""), (support("privileges") ? "<a href='" . h(ME) . "privileges='>" . lang(59) . "</a>\n" : "");return
            true;}public function
    navigation($Hd) {
        global $fa, $y, $Eb, $g;
        echo '<h1>
', $this->name(), ' <span class="version">', $fa, '</span>
<a href="http://www.adminer.org/#download" target="_blank" id="version">', (version_compare($fa, $_COOKIE["adminer_version"]) < 0 ? h($_COOKIE["adminer_version"]) : ""), '</a>
</h1>
';if ($Hd == "auth") {
            $pc = true;foreach ((array) $_SESSION["pwds"] as $Mg => $zf) {foreach ($zf as $O => $Ig) {
                foreach ($Ig as $V => $_e) {
                    if ($_e !== null) {if ($pc) {echo "<p id='logins' onmouseover='menuOver(this, event);' onmouseout='menuOut(this);'>\n";
                        $pc = false;}$tb = $_SESSION["db"][$Mg][$O][$V];foreach (($tb ? array_keys($tb) : array("")) as $k) {
                        echo "<a href='" . h(auth_url($Mg, $O, $V, $k)) . "'>($Eb[$Mg]) " . h($V . ($O != "" ? "@$O" : "") . ($k != "" ? " - $k" : "")) . "</a><br>\n";
                    }
                    }}}}} else {
            if ($_GET["ns"] !== "" && !$Hd && DB != "") {$g->select_db(DB);
                $S = table_status('', true);}if (support("sql")) {
                echo '<script type="text/javascript" src="', h(preg_replace("~\\?.*~", "", ME)) . "?file=jush.js&amp;version=4.2.1&amp;driver=mysql", '"></script>
<script type="text/javascript">
';if ($S) {$sd = array();foreach ($S as $Q => $U) {
                    $sd[] = preg_quote($Q, '/');
                }

                    echo "var jushLinks = { $y: [ '" . js_escape(ME) . (support("table") ? "table=" : "select=") . "\$&', /\\b(" . implode("|", $sd) . ")\\b/g ] };\n";foreach (array("bac", "bra", "sqlite_quo", "mssql_bra") as $X) {
                        echo "jushLinks.$X = jushLinks.$y;\n";
                    }
                }echo 'bodyLoad(\'', (is_object($g) ? substr($g->server_info, 0, 3) : ""), '\');
</script>
';}$this->databasesPrint($Hd);if (DB == "" || !$Hd) {
                echo "<p class='links'>" . (support("sql") ? "<a href='" . h(ME) . "sql='" . bold(isset($_GET["sql"]) && !isset($_GET["import"])) . ">" . lang(51) . "</a>\n<a href='" . h(ME) . "import='" . bold(isset($_GET["import"])) . ">" . lang(60) . "</a>\n" : "") . "";if (support("dump")) {
                    echo "<a href='" . h(ME) . "dump=" . urlencode(isset($_GET["table"]) ? $_GET["table"] : $_GET["select"]) . "' id='dump'" . bold(isset($_GET["dump"])) . ">" . lang(61) . "</a>\n";
                }
            }if ($_GET["ns"] !== "" && !$Hd && DB != "") {
                echo '<a href="' . h(ME) . 'create="' . bold($_GET["create"] === "") . ">" . lang(62) . "</a>\n";if (!$S) {
                    echo "<p class='message'>" . lang(9) . "\n";
                } else {
                    $this->tablesPrint($S);
                }
            }}}public function
    databasesPrint($Hd) {
        global $c, $g;
        $j = $this->databases();
        echo '<form action="">
<p id="dbs">
';
        hidden_fields_get();
        $rb = " onmousedown='dbMouseDown(event, this);' onchange='dbChange(this);'";
        echo "<span title='" . lang(63) . "'>DB</span>: " . ($j ? "<select name='db'$rb>" . optionlist(array("" => "") + $j, DB) . "</select>" : '<input name="db" value="' . h(DB) . '" autocapitalize="off">'), "<input type='submit' value='" . lang(20) . "'" . ($j ? " class='hidden'" : "") . ">\n";if ($Hd != "db" && DB != "" && $g->select_db(DB)) {}echo (isset($_GET["sql"]) ? '<input type="hidden" name="sql" value="">' : (isset($_GET["schema"]) ? '<input type="hidden" name="schema" value="">' : (isset($_GET["dump"]) ? '<input type="hidden" name="dump" value="">' : (isset($_GET["privileges"]) ? '<input type="hidden" name="privileges" value="">' : "")))), "</p></form>\n";}public function
    tablesPrint($S) {
        echo "<p id='tables' onmouseover='menuOver(this, event);' onmouseout='menuOut(this);'>\n";foreach ($S as $Q => $Gf) {
            echo '<a href="' . h(ME) . 'select=' . urlencode($Q) . '"' . bold($_GET["select"] == $Q || $_GET["edit"] == $Q, "select") . ">" . lang(64) . "</a> ";
            $F = $this->tableName($Gf);
            echo (support("table") || support("indexes") ? '<a href="' . h(ME) . 'table=' . urlencode($Q) . '"' . bold(in_array($Q, array($_GET["table"], $_GET["create"], $_GET["indexes"], $_GET["foreign"], $_GET["trigger"])), (is_view($Gf) ? "view" : ""), "structure") . " title='" . lang(35) . "'>$F</a>" : "<span>$F</span>") . "<br>\n";}}}$c = (function_exists('adminer_object') ? adminer_object() : new
    Adminer);if ($c->operators === null) {
    $c->operators = $de;
}
function
page_header($hg, $m = "", $Ha = array(), $ig = "") {
    global $a, $fa, $c, $Eb, $y;
    page_headers();if (is_ajax() && $m) {page_messages($m);exit;}
    $jg = $hg . ($ig != "" ? ": $ig" : "");
    $kg = strip_tags($jg . (SERVER != "" && SERVER != "localhost" ? h(" - " . SERVER) : "") . " - " . $c->name());
    echo '<!DOCTYPE html>
<html lang="', $a, '" dir="', lang(65), '">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta name="robots" content="noindex">
<meta name="referrer" content="origin-when-crossorigin">
<title>', $kg, '</title>
<link rel="stylesheet" type="text/css" href="', h(preg_replace("~\\?.*~", "", ME)) . "?file=default.css&amp;version=4.2.1&amp;driver=mysql", '">
<script type="text/javascript" src="', h(preg_replace("~\\?.*~", "", ME)) . "?file=functions.js&amp;version=4.2.1&amp;driver=mysql", '"></script>
';if ($c->head()) {echo '<link rel="shortcut icon" type="image/x-icon" href="', h(preg_replace("~\\?.*~", "", ME)) . "?file=favicon.ico&amp;version=4.2.1&amp;driver=mysql", '">
<link rel="apple-touch-icon" href="', h(preg_replace("~\\?.*~", "", ME)) . "?file=favicon.ico&amp;version=4.2.1&amp;driver=mysql", '">
';if (file_exists("adminer.css")) {echo '<link rel="stylesheet" type="text/css" href="adminer.css">
';}}
    echo '
<body class="', lang(65), ' nojs" onkeydown="bodyKeydown(event);" onclick="bodyClick(event);"', (isset($_COOKIE["adminer_version"]) ? "" : " onload=\"verifyVersion('$fa');\""); ?>>
<script type="text/javascript">
document.body.className = document.body.className.replace(/ nojs/, ' js');
var offlineMessage = '<?php echo
    js_escape(lang(66)), '\';
</script>

<div id="help" class="jush-', $y, ' jsonly hidden" onmouseover="helpOpen = 1;" onmouseout="helpMouseout(this, event);"></div>

<div id="content">
';if ($Ha !== null) {
        $A = substr(preg_replace('~\b(username|db|ns)=[^&]*&~', '', ME), 0, -1);
        echo '<p id="breadcrumb"><a href="' . h($A ? $A : ".") . '">' . $Eb[DRIVER] . '</a> &raquo; ';
        $A = substr(preg_replace('~\b(db|ns)=[^&]*&~', '', ME), 0, -1);
        $O = (SERVER != "" ? h(SERVER) : lang(28));if ($Ha === false) {
            echo "$O\n";
        } else {
            echo "<a href='" . ($A ? h($A) : ".") . "' accesskey='1' title='Alt+Shift+1'>$O</a> &raquo; ";if ($_GET["ns"] != "" || (DB != "" && is_array($Ha))) {
                echo '<a href="' . h($A . "&db=" . urlencode(DB) . (support("scheme") ? "&ns=" : "")) . '">' . h(DB) . '</a> &raquo; ';
            }
            if (is_array($Ha)) {
                if ($_GET["ns"] != "") {
                    echo '<a href="' . h(substr(ME, 0, -1)) . '">' . h($_GET["ns"]) . '</a> &raquo; ';
                }
                foreach ($Ha as $z => $X) {
                    $xb = (is_array($X) ? $X[1] : h($X));if ($xb != "") {
                        echo "<a href='" . h(ME . "$z=") . urlencode(is_array($X) ? $X[0] : $X) . "'>$xb</a> &raquo; ";
                    }
                }}
            echo "$hg\n";}}
    echo "<h2>$jg</h2>\n", "<div id='ajaxstatus' class='jsonly hidden'></div>\n";
    restart_session();
    page_messages($m);
    $j = &get_session("dbs");if (DB != "" && $j && !in_array(DB, $j, true)) {
        $j = null;
    }

    stop_session();
    define("PAGE_HEADER", 1);}function
page_headers() {
    global $c;
    header("Content-Type: text/html; charset=utf-8");
    header("Cache-Control: no-cache");if ($c->headers()) {
        header("X-Frame-Options: deny");
        header("X-XSS-Protection: 0");}}function
page_messages($m) {
    $Eg = preg_replace('~^[^?]*~', '', $_SERVER["REQUEST_URI"]);
    $Fd = $_SESSION["messages"][$Eg];if ($Fd) {echo "<div class='message'>" . implode("</div>\n<div class='message'>", $Fd) . "</div>\n";unset($_SESSION["messages"][$Eg]);}if ($m) {
        echo "<div class='error'>$m</div>\n";
    }
}function
page_footer($Hd = "") {
    global $c, $T;
    echo '</div>

';
    switch_lang();if ($Hd != "auth") {echo '<form action="" method="post">
<p class="logout">
<input type="submit" name="logout" value="', lang(67), '" id="logout">
<input type="hidden" name="token" value="', $T, '">
</p>
</form>
';}
    echo '<div id="menu">
';
    $c->navigation($Hd);
    echo '</div>
<script type="text/javascript">setupSubmitHighlight(document);</script>
';}function
int32($E) {
    while ($E >= 2147483648) {
        $E -= 4294967296;
    }
    while ($E <= -2147483649) {
        $E += 4294967296;
    }
    return (int) $E;}function
long2str($W, $Qg) {
    $pf = '';foreach ($W as $X) {
        $pf .= pack('V', $X);
    }
    if ($Qg) {
        return
        substr($pf, 0, end($W));
    }
    return $pf;}function
str2long($pf, $Qg) {
    $W = array_values(unpack('V*', str_pad($pf, 4 * ceil(strlen($pf) / 4), "\0")));if ($Qg) {
        $W[] = strlen($pf);
    }
    return $W;}function
xxtea_mx($Vg, $Ug, $Of, $bd) {
    return
    int32((($Vg >> 5 & 0x7FFFFFF) ^ $Ug << 2) + (($Ug >> 3 & 0x1FFFFFFF) ^ $Vg << 4)) ^ int32(($Of ^ $Ug) + ($bd ^ $Vg));}function
encrypt_string($If, $z) {
    if ($If == "") {
        return "";
    }

    $z  = array_values(unpack("V*", pack("H*", md5($z))));
    $W  = str2long($If, true);
    $E  = count($W) - 1;
    $Vg = $W[$E];
    $Ug = $W[0];
    $H  = floor(6 + 52 / ($E + 1));
    $Of = 0;while ($H-- > 0) {
        $Of = int32($Of + 0x9E3779B9);
        $Kb = $Of >> 2 & 3;for ($re = 0; $re < $E; $re++) {
            $Ug     = $W[$re + 1];
            $Jd     = xxtea_mx($Vg, $Ug, $Of, $z[$re & 3 ^ $Kb]);
            $Vg     = int32($W[$re] + $Jd);
            $W[$re] = $Vg;}
        $Ug    = $W[0];
        $Jd    = xxtea_mx($Vg, $Ug, $Of, $z[$re & 3 ^ $Kb]);
        $Vg    = int32($W[$E] + $Jd);
        $W[$E] = $Vg;}
    return
    long2str($W, false);}function
decrypt_string($If, $z) {
    if ($If == "") {
        return "";
    }
    if (!$z) {
        return
            false;
    }

    $z  = array_values(unpack("V*", pack("H*", md5($z))));
    $W  = str2long($If, false);
    $E  = count($W) - 1;
    $Vg = $W[$E];
    $Ug = $W[0];
    $H  = floor(6 + 52 / ($E + 1));
    $Of = int32($H * 0x9E3779B9);while ($Of) {
        $Kb = $Of >> 2 & 3;for ($re = $E; $re > 0; $re--) {$Vg = $W[$re - 1];
            $Jd                            = xxtea_mx($Vg, $Ug, $Of, $z[$re & 3 ^ $Kb]);
            $Ug                            = int32($W[$re] - $Jd);
            $W[$re]                        = $Ug;}
        $Vg   = $W[$E];
        $Jd   = xxtea_mx($Vg, $Ug, $Of, $z[$re & 3 ^ $Kb]);
        $Ug   = int32($W[0] - $Jd);
        $W[0] = $Ug;
        $Of   = int32($Of - 0x9E3779B9);}
    return
    long2str($W, true);}$g = '';
$Dc                    = $_SESSION["token"];if (!$Dc) {
    $_SESSION["token"] = rand(1, 1e6);
}

$T  = get_token();
$Ce = array();if ($_COOKIE["adminer_permanent"]) {
    foreach (explode(" ", $_COOKIE["adminer_permanent"]) as $X) {list($z) = explode(":", $X);
        $Ce[$z]                             = $X;}}
function
add_invalid_login() {
    global $c;
    $nc = get_temp_dir() . "/adminer.invalid";
    $r  = @fopen($nc, "r+");if (!$r) {
        $r = @fopen($nc, "w");if (!$r) {
            return;
        }
    }
    flock($r, LOCK_EX);
    $Uc = unserialize(stream_get_contents($r));
    $eg = time();if ($Uc) {
        foreach ($Uc as $Vc => $X) {
            if ($X[0] < $eg) {
                unset($Uc[$Vc]);
            }
        }}
    $Tc = &$Uc[$c->bruteForceKey()];if (!$Tc) {
        $Tc = array($eg + 30 * 60, 0);
    }

    $Tc[1]++;
    $xf = serialize($Uc);
    rewind($r);
    fwrite($r, $xf);
    ftruncate($r, strlen($xf));
    flock($r, LOCK_UN);
    fclose($r);}$xa = $_POST["auth"];if ($xa) {
    $Uc = unserialize(@file_get_contents(get_temp_dir() . "/adminer.invalid"));
    $Tc = $Uc[$c->bruteForceKey()];
    $Od = ($Tc[1] > 30 ? $Tc[0] - time() : 0);if ($Od > 0) {
        auth_error(lang(68, ceil($Od / 60)));
    }

    session_regenerate_id();
    $Mg = $xa["driver"];
    $O  = $xa["server"];
    $V  = $xa["username"];
    $_e = (string) $xa["password"];
    $k  = $xa["db"];
    set_password($Mg, $O, $V, $_e);
    $_SESSION["db"][$Mg][$O][$V][$k] = true;if ($xa["permanent"]) {
        $z      = base64_encode($Mg) . "-" . base64_encode($O) . "-" . base64_encode($V) . "-" . base64_encode($k);
        $Ne     = $c->permanentLogin(true);
        $Ce[$z] = "$z:" . base64_encode($Ne ? encrypt_string($_e, $Ne) : "");
        cookie("adminer_permanent", implode(" ", $Ce));}if (count($_POST) == 1 || DRIVER != $Mg || SERVER != $O || $_GET["username"] !== $V || DB != $k) {
        redirect(auth_url($Mg, $O, $V, $k));
    }
} elseif ($_POST["logout"]) {
    if ($Dc && !verify_token()) {page_header(lang(67), lang(69));
        page_footer("db");exit;} else {
        foreach (array("pwds", "db", "dbs", "queries") as $z) {
            set_session($z, null);
        }

        unset_permanent();
        redirect(substr(preg_replace('~\b(username|db|ns)=[^&]*&~', '', ME), 0, -1), lang(70));}} elseif ($Ce && !$_SESSION["pwds"]) {
    session_regenerate_id();
    $Ne = $c->permanentLogin();foreach ($Ce as $z => $X) {
        list(, $Qa) = explode(":", $X);list($Mg, $O, $V, $k) = array_map('base64_decode', explode("-", $z));
        set_password($Mg, $O, $V, decrypt_string(base64_decode($Qa), $Ne));
        $_SESSION["db"][$Mg][$O][$V][$k] = true;}}
function
unset_permanent() {
    global $Ce;foreach ($Ce as $z => $X) {
        list($Mg, $O, $V, $k) = array_map('base64_decode', explode("-", $z));if ($Mg == DRIVER && $O == SERVER && $V == $_GET["username"] && $k == DB) {
            unset($Ce[$z]);
        }
    }
    cookie("adminer_permanent", implode(" ", $Ce));}function
auth_error($m) {
    global $c, $Dc;
    $m  = h($m);
    $_f = session_name();if (isset($_GET["username"])) {
        header("HTTP/1.1 403 Forbidden");if (($_COOKIE[$_f] || $_GET[$_f]) && !$Dc) {
            $m = lang(71);
        } else {
            add_invalid_login();
            $_e = get_password();if ($_e !== null) {
                if ($_e === false) {
                    $m .= '<br>' . lang(72, '<code>permanentLogin()</code>');
                }

                set_password(DRIVER, SERVER, $_GET["username"], null);}
            unset_permanent();}}if (!$_COOKIE[$_f] && $_GET[$_f] && ini_bool("session.use_only_cookies")) {
        $m = lang(73);
    }

    $te = session_get_cookie_params();
    cookie("adminer_key", ($_COOKIE["adminer_key"] ? $_COOKIE["adminer_key"] : rand_string()), $te["lifetime"]);
    page_header(lang(32), $m, null);
    echo "<form action='' method='post'>\n";
    $c->loginForm();
    echo "<div>";
    hidden_fields($_POST, array("auth"));
    echo "</div>\n", "</form>\n";
    page_footer("auth");exit;}if (isset($_GET["username"])) {
    if (!class_exists("Min_DB")) {unset($_SESSION["pwds"][DRIVER]);
        unset_permanent();
        page_header(lang(74), lang(75, implode(", ", $Ie)), false);
        page_footer("auth");exit;}
    $g = connect();}
$l = new
Min_Driver($g);if (!is_object($g) || !$c->login($_GET["username"], get_password())) {
    auth_error((is_string($g) ? $g : lang(76)));
}
if ($xa && $_POST["token"]) {
    $_POST["token"] = $T;
}

$m = '';if ($_POST) {
    if (!verify_token()) {$Oc = "max_input_vars";
        $Ad                            = ini_get($Oc);if (extension_loaded("suhosin")) {
            foreach (array("suhosin.request.max_vars", "suhosin.post.max_vars") as $z) {$X = ini_get($z);if ($X && (!$Ad || $X < $Ad)) {$Oc = $z;
                $Ad                            = $X;}}}
        $m = (!$_POST["token"] && $Ad ? lang(77, "'$Oc'") : lang(69) . ' ' . lang(78));}} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    $m = lang(79, "'post_max_size'");if (isset($_GET["sql"])) {
        $m .= ' ' . lang(80);
    }
}if (!ini_bool("session.use_cookies") || @ini_set("session.use_cookies", false) !== false) {
    session_write_close();
}
function
select($J, $h = null, $ke = array(), $_ = 0) {
    global $y;
    $sd = array();
    $x  = array();
    $e  = array();
    $Fa = array();
    $wg = array();
    $K  = array();
    odd('');for ($v = 0; (!$_ || $v < $_) && ($L = $J->fetch_row()); $v++) {
        if (!$v) {echo "<table cellspacing='0' class='nowrap'>\n", "<thead><tr>";for ($ad = 0; $ad < count($L); $ad++) {$n = $J->fetch_field();
            $F                            = $n->name;
            $je                           = $n->orgtable;
            $ie                           = $n->orgname;
            $K[$n->table]                 = $je;if ($ke && $y == "sql") {
                $sd[$ad] = ($F == "table" ? "table=" : ($F == "possible_keys" ? "indexes=" : null));
            } elseif ($je != "") {
                if (!isset($x[$je])) {$x[$je] = array();foreach (indexes($je, $h) as $w) {if ($w["type"] == "PRIMARY") {$x[$je] = array_flip($w["columns"]);
                    break;}}
                    $e[$je] = $x[$je];}if (isset($e[$je][$ie])) {
                    unset($e[$je][$ie]);
                    $x[$je][$ie] = $ad;
                    $sd[$ad]     = $je;}}if ($n->charsetnr == 63) {
                $Fa[$ad] = true;
            }

            $wg[$ad] = $n->type;
            echo "<th" . ($je != "" || $n->name != $ie ? " title='" . h(($je != "" ? "$je." : "") . $ie) . "'" : "") . ">" . h($F) . ($ke ? doc_link(array('sql' => "explain-output.html#explain_" . strtolower($F))) : "");}
            echo "</thead>\n";}
        echo "<tr" . odd() . ">";foreach ($L as $z => $X) {
            if ($X === null) {
                $X = "<i>NULL</i>";
            } elseif ($Fa[$z] && !is_utf8($X)) {
                $X = "<i>" . lang(39, strlen($X)) . "</i>";
            } elseif (!strlen($X)) {
                $X = "&nbsp;";
            } else {
                $X = h($X);if ($wg[$z] == 254) {
                    $X = "<code>$X</code>";
                }
            }if (isset($sd[$z]) && !$e[$sd[$z]]) {
                if ($ke && $y == "sql") {$Q = $L[array_search("table=", $sd)];
                    $A                            = $sd[$z] . urlencode($ke[$Q] != "" ? $ke[$Q] : $Q);} else {
                    $A = "edit=" . urlencode($sd[$z]);foreach ($x[$sd[$z]] as $Ua => $ad) {
                        $A .= "&where" . urlencode("[" . bracket_escape($Ua) . "]") . "=" . urlencode($L[$ad]);
                    }
                }
                $X = "<a href='" . h(ME . $A) . "'>$X</a>";}
            echo "<td>$X";}}
    echo ($v ? "</table>" : "<p class='message'>" . lang(12)) . "\n";return $K;}function
referencable_primary($vf) {
    $K = array();foreach (table_status('', true) as $Sf => $Q) {if ($Sf != $vf && fk_support($Q)) {foreach (fields($Sf) as $n) {if ($n["primary"]) {if ($K[$Sf]) {unset($K[$Sf]);
        break;}
        $K[$Sf] = $n;}}}}
    return $K;}function
textarea($F, $Y, $M = 10, $Ya = 80) {
    global $y;
    echo "<textarea name='$F' rows='$M' cols='$Ya' class='sqlarea jush-$y' spellcheck='false' wrap='off'>";if (is_array($Y)) {
        foreach ($Y as $X) {
            echo
            h($X[0]) . "\n\n\n";
        }
    } else {
        echo
        h($Y);
    }

    echo "</textarea>";}function
edit_type($z, $n, $Xa, $q = array()) {
    global $Kf, $wg, $Cg, $Zd;
    $U = $n["type"];
    echo '<td><select name="', $z, '[type]" class="type" onfocus="lastType = selectValue(this);" onchange="editingTypeChange(this);"', on_help("getTarget(event).value", 1), '>';if ($U && !isset($wg[$U]) && !isset($q[$U])) {
        array_unshift($Kf, $U);
    }
    if ($q) {
        $Kf[lang(81)] = $q;
    }

    echo
    optionlist($Kf, $U), '</select>
<td><input name="', $z, '[length]" value="', h($n["length"]), '" size="3" onfocus="editingLengthFocus(this);"', (!$n["length"] && preg_match('~var(char|binary)$~', $U) ? " class='required'" : ""), ' onchange="editingLengthChange(this);" onkeyup="this.onchange();"><td class="options">';
    echo "<select name='$z" . "[collation]'" . (preg_match('~(char|text|enum|set)$~', $U) ? "" : " class='hidden'") . '><option value="">(' . lang(82) . ')' . optionlist($Xa, $n["collation"]) . '</select>', ($Cg ? "<select name='$z" . "[unsigned]'" . (!$U || preg_match('~((^|[^o])int|float|double|decimal)$~', $U) ? "" : " class='hidden'") . '><option>' . optionlist($Cg, $n["unsigned"]) . '</select>' : ''), (isset($n['on_update']) ? "<select name='$z" . "[on_update]'" . (preg_match('~timestamp|datetime~', $U) ? "" : " class='hidden'") . '>' . optionlist(array("" => "(" . lang(83) . ")", "CURRENT_TIMESTAMP"), $n["on_update"]) . '</select>' : ''), ($q ? "<select name='$z" . "[on_delete]'" . (preg_match("~`~", $U) ? "" : " class='hidden'") . "><option value=''>(" . lang(84) . ")" . optionlist(explode("|", $Zd), $n["on_delete"]) . "</select> " : " ");}function
process_length($od) {global $Vb;return (preg_match("~^\\s*\\(?\\s*$Vb(?:\\s*,\\s*$Vb)*+\\s*\\)?\\s*\$~", $od) && preg_match_all("~$Vb~", $od, $vd) ? "(" . implode(",", $vd[0]) . ")" : preg_replace('~^[0-9].*~', '(\0)', preg_replace('~[^-0-9,+()[\]]~', '', $od)));}function
process_type($n, $Va = "COLLATE") {global $Cg;return " $n[type]" . process_length($n["length"]) . (preg_match('~(^|[^o])int|float|double|decimal~', $n["type"]) && in_array($n["unsigned"], $Cg) ? " $n[unsigned]" : "") . (preg_match('~char|text|enum|set~', $n["type"]) && $n["collation"] ? " $Va " . q($n["collation"]) : "");}function
process_field($n, $ug) {
    global $y;
    $vb = $n["default"];return
    array(idf_escape(trim($n["field"])), process_type($ug), ($n["null"] ? " NULL" : " NOT NULL"), (isset($vb) ? " DEFAULT " . ((preg_match('~time~', $n["type"]) && preg_match('~^CURRENT_TIMESTAMP$~i', $vb)) || ($y == "sqlite" && preg_match('~^CURRENT_(TIME|TIMESTAMP|DATE)$~i', $vb)) || ($n["type"] == "bit" && preg_match("~^([0-9]+|b'[0-1]+')\$~", $vb)) || ($y == "pgsql" && preg_match("~^[a-z]+\\(('[^']*')+\\)\$~", $vb)) ? $vb : q($vb)) : ""), (preg_match('~timestamp|datetime~', $n["type"]) && $n["on_update"] ? " ON UPDATE $n[on_update]" : ""), (support("comment") && $n["comment"] != "" ? " COMMENT " . q($n["comment"]) : ""), ($n["auto_increment"] ? auto_increment() : null));}function
type_class($U) {
    foreach (array('char' => 'text', 'date' => 'time|year', 'binary' => 'blob', 'enum' => 'set') as $z => $X) {if (preg_match("~$z|$X~", $U)) {
        return " class='$z'";
    }
    }}function
edit_fields($o, $Xa, $U = "TABLE", $q = array(), $cb = false) {
    global $g, $Pc;
    echo '<thead><tr class="wrap">
';if ($U == "PROCEDURE") {echo '<td>&nbsp;';}
    echo '<th>', ($U == "TABLE" ? lang(85) : lang(86)), '<td>', lang(87), '<textarea id="enum-edit" rows="4" cols="12" wrap="off" style="display: none;" onblur="editingLengthBlur(this);"></textarea>
<td>', lang(88), '<td>', lang(89);if ($U == "TABLE") {echo '<td>NULL
<td><input type="radio" name="auto_increment_col" value=""><acronym title="', lang(52), '">AI</acronym>', doc_link(array('sql' => "example-auto-increment.html", 'sqlite' => "autoinc.html", 'pgsql' => "datatype.html#DATATYPE-SERIAL", 'mssql' => "ms186775.aspx")), '<td>', lang(90), (support("comment") ? "<td" . ($cb ? "" : " class='hidden'") . ">" . lang(91) : "");}
    echo '<td>', "<input type='image' class='icon' name='add[" . (support("move_col") ? 0 : count($o)) . "]' src='" . h(preg_replace("~\\?.*~", "", ME)) . "?file=plus.gif&amp;version=4.2.1&amp;driver=mysql' alt='+' title='" . lang(92) . "'>", '<script type="text/javascript">row_count = ', count($o), ';</script>
</thead>
<tbody onkeydown="return editingKeydown(event);">
';foreach ($o as $v => $n) {
        $v++;
        $le = $n[($_POST ? "orig" : "field")];
        $Ab = (isset($_POST["add"][$v - 1]) || (isset($n["field"]) && !$_POST["drop_col"][$v])) && (support("drop_col") || $le == "");
        echo '<tr', ($Ab ? "" : " style='display: none;'"), '>
', ($U == "PROCEDURE" ? "<td>" . html_select("fields[$v][inout]", explode("|", $Pc), $n["inout"]) : ""), '<th>';if ($Ab) {echo '<input name="fields[', $v, '][field]" value="', h($n["field"]), '" onchange="editingNameChange(this);', ($n["field"] != "" || count($o) > 1 ? '' : ' editingAddRow(this);" onkeyup="if (this.value) editingAddRow(this);'), '" maxlength="64" autocapitalize="off">';}
        echo '<input type="hidden" name="fields[', $v, '][orig]" value="', h($le), '">
';
        edit_type("fields[$v]", $n, $Xa, $q);if ($U == "TABLE") {
            echo '<td>', checkbox("fields[$v][null]", 1, $n["null"], "", "", "block"), '<td><label class="block"><input type="radio" name="auto_increment_col" value="', $v, '"';if ($n["auto_increment"]) {echo ' checked';} ?> onclick="var field = this.form['fields[' + this.value + '][field]']; if (!field.value) { field.value = 'id'; field.onchange(); }"></label><td><?php
echo
            checkbox("fields[$v][has_default]", 1, $n["has_default"]), '<input name="fields[', $v, '][default]" value="', h($n["default"]), '" onkeyup="keyupChange.call(this);" onchange="this.previousSibling.checked = true;">
', (support("comment") ? "<td" . ($cb ? "" : " class='hidden'") . "><input name='fields[$v][comment]' value='" . h($n["comment"]) . "' maxlength='" . ($g->server_info >= 5.5 ? 1024 : 255) . "'>" : "");}
        echo "<td>", (support("move_col") ? "<input type='image' class='icon' name='add[$v]' src='" . h(preg_replace("~\\?.*~", "", ME)) . "?file=plus.gif&amp;version=4.2.1&amp;driver=mysql' alt='+' title='" . lang(92) . "' onclick='return !editingAddRow(this, 1);'>&nbsp;" . "<input type='image' class='icon' name='up[$v]' src='" . h(preg_replace("~\\?.*~", "", ME)) . "?file=up.gif&amp;version=4.2.1&amp;driver=mysql' alt='^' title='" . lang(93) . "'>&nbsp;" . "<input type='image' class='icon' name='down[$v]' src='" . h(preg_replace("~\\?.*~", "", ME)) . "?file=down.gif&amp;version=4.2.1&amp;driver=mysql' alt='v' title='" . lang(94) . "'>&nbsp;" : ""), ($le == "" || support("drop_col") ? "<input type='image' class='icon' name='drop_col[$v]' src='" . h(preg_replace("~\\?.*~", "", ME)) . "?file=cross.gif&amp;version=4.2.1&amp;driver=mysql' alt='x' title='" . lang(95) . "' onclick=\"return !editingRemoveRow(this, 'fields\$1[field]');\">" : ""), "\n";}}function
process_fields(&$o) {
    ksort($o);
    $Sd = 0;if ($_POST["up"]) {
        $id = 0;foreach ($o as $z => $n) {
            if (key($_POST["up"]) == $z) {unset($o[$z]);
                array_splice($o, $id, 0, array($n));
                break;}if (isset($n["field"])) {
                $id = $Sd;
            }

            $Sd++;}} elseif ($_POST["down"]) {
        $uc = false;foreach ($o as $z => $n) {
            if (isset($n["field"]) && $uc) {unset($o[key($_POST["down"])]);
                array_splice($o, $Sd, 0, array($uc));
                break;}if (key($_POST["down"]) == $z) {
                $uc = $n;
            }

            $Sd++;}} elseif ($_POST["add"]) {
        $o = array_values($o);
        array_splice($o, key($_POST["add"]), 0, array(array()));} elseif (!$_POST["drop_col"]) {
        return
            false;
    }
    return
        true;}function
normalize_enum($C) {return "'" . str_replace("'", "''", addcslashes(stripcslashes(str_replace($C[0][0] . $C[0][0], $C[0][0], substr($C[0], 1, -1))), '\\')) . "'";}function
grant($t, $Pe, $e, $Yd) {
    if (!$Pe) {
        return
            true;
    }
    if ($Pe == array("ALL PRIVILEGES", "GRANT OPTION")) {
        return ($t == "GRANT" ? queries("$t ALL PRIVILEGES$Yd WITH GRANT OPTION") : queries("$t ALL PRIVILEGES$Yd") && queries("$t GRANT OPTION$Yd"));
    }
    return
    queries("$t " . preg_replace('~(GRANT OPTION)\\([^)]*\\)~', '\\1', implode("$e, ", $Pe) . $e) . $Yd);}function
drop_create($Fb, $i, $Gb, $bg, $Hb, $B, $Ed, $Cd, $Dd, $Vd, $Md) {
    if ($_POST["drop"]) {
        query_redirect($Fb, $B, $Ed);
    } elseif ($Vd == "") {
        query_redirect($i, $B, $Dd);
    } elseif ($Vd != $Md) {
        $lb = queries($i);
        queries_redirect($B, $Cd, $lb && queries($Fb));if ($lb) {
            queries($Gb);
        }
    } else {
        queries_redirect($B, $Cd, queries($bg) && queries($Hb) && queries($Fb) && queries($i));
    }
}function
create_trigger($Yd, $L) {
    global $y;
    $gg = " $L[Timing] $L[Event]" . ($L["Event"] == "UPDATE OF" ? " " . idf_escape($L["Of"]) : "");return "CREATE TRIGGER " . idf_escape($L["Trigger"]) . ($y == "mssql" ? $Yd . $gg : $gg . $Yd) . rtrim(" $L[Type]\n$L[Statement]", ";") . ";";}function
create_routine($mf, $L) {
    global $Pc;
    $P = array();
    $o = (array) $L["fields"];
    ksort($o);foreach ($o as $n) {
        if ($n["field"] != "") {
            $P[] = (preg_match("~^($Pc)\$~", $n["inout"]) ? "$n[inout] " : "") . idf_escape($n["field"]) . process_type($n, "CHARACTER SET");
        }
    }
    return "CREATE $mf " . idf_escape(trim($L["name"])) . " (" . implode(", ", $P) . ")" . (isset($_GET["function"]) ? " RETURNS" . process_type($L["returns"], "CHARACTER SET") : "") . ($L["language"] ? " LANGUAGE $L[language]" : "") . rtrim("\n$L[definition]", ";") . ";";}function
remove_definer($I) {
    return
    preg_replace('~^([A-Z =]+) DEFINER=`' . preg_replace('~@(.*)~', '`@`(%|\\1)', logged_user()) . '`~', '\\1', $I);}function
format_foreign_key($p) {global $Zd;return " FOREIGN KEY (" . implode(", ", array_map('idf_escape', $p["source"])) . ") REFERENCES " . table($p["table"]) . " (" . implode(", ", array_map('idf_escape', $p["target"])) . ")" . (preg_match("~^($Zd)\$~", $p["on_delete"]) ? " ON DELETE $p[on_delete]" : "") . (preg_match("~^($Zd)\$~", $p["on_update"]) ? " ON UPDATE $p[on_update]" : "");}function
tar_file($nc, $lg) {
    $K  = pack("a100a8a8a8a12a12", $nc, 644, 0, 0, decoct($lg->size), decoct(time()));
    $Pa = 8 * 32;for ($v = 0; $v < strlen($K); $v++) {
        $Pa += ord($K[$v]);
    }

    $K .= sprintf("%06o", $Pa) . "\0 ";
    echo $K, str_repeat("\0", 512 - strlen($K));
    $lg->send();
    echo
    str_repeat("\0", 511 - ($lg->size + 511) % 512);}function
ini_bytes($Oc) {$X = ini_get($Oc);switch (strtolower(substr($X, -1))) {case 'g':$X *= 1024;case 'm':$X *= 1024;case 'k':$X *= 1024;}return $X;}function
doc_link($Ae) {
    global $y, $g;
    $Fg = array('sql' => "http://dev.mysql.com/doc/refman/" . substr($g->server_info, 0, 3) . "/en/", 'sqlite' => "http://www.sqlite.org/", 'pgsql' => "http://www.postgresql.org/docs/" . substr($g->server_info, 0, 3) . "/static/", 'mssql' => "http://msdn.microsoft.com/library/", 'oracle' => "http://download.oracle.com/docs/cd/B19306_01/server.102/b14200/");return ($Ae[$y] ? "<a href='$Fg[$y]$Ae[$y]' target='_blank' rel='noreferrer'><sup>?</sup></a>" : "");}function
ob_gzencode($Jf) {
    return
    gzencode($Jf);}function
db_size($k) {
    global $g;if (!$g->select_db($k)) {
        return "?";
    }

    $K = 0;foreach (table_status() as $R) {
        $K += $R["Data_length"] + $R["Index_length"];
    }
    return
    format_number($K);}function
set_utf8mb4($i) {
    global $g;static $P = false;if (!$P && preg_match('~\butf8mb4~i', $i)) {$P = true;
        echo "SET NAMES " . charset($g) . ";\n\n";}}function
connect_error() {
    global $c, $g, $T, $m, $Eb;if (DB != "") {header("HTTP/1.1 404 Not Found");
        page_header(lang(31) . ": " . h(DB), lang(96), true);} else {
        if ($_POST["db"] && !$m) {
            queries_redirect(substr(ME, 0, -1), lang(97), drop_databases($_POST["db"]));
        }

        page_header(lang(98), $m, false);
        echo "<p class='links'>\n";foreach (array('database' => lang(99), 'privileges' => lang(59), 'processlist' => lang(100), 'variables' => lang(101), 'status' => lang(102)) as $z => $X) {
            if (support($z)) {
                echo "<a href='" . h(ME) . "$z='>$X</a>\n";
            }
        }
        echo "<p>" . lang(103, $Eb[DRIVER], "<b>" . h($g->server_info) . "</b>", "<b>$g->extension</b>") . "\n", "<p>" . lang(104, "<b>" . h(logged_user()) . "</b>") . "\n";
        $j = $c->databases();if ($j) {
            $sf = support("scheme");
            $Xa = collations();
            echo "<form action='' method='post'>\n", "<table cellspacing='0' class='checkable' onclick='tableClick(event);' ondblclick='tableClick(event, true);'>\n", "<thead><tr>" . (support("database") ? "<td>&nbsp;" : "") . "<th>" . lang(31) . " - <a href='" . h(ME) . "refresh=1'>" . lang(105) . "</a>" . "<td>" . lang(106) . "<td>" . lang(107) . "<td>" . lang(108) . " - <a href='" . h(ME) . "dbsize=1' onclick=\"return !ajaxSetHtml('" . js_escape(ME) . "script=connect');\">" . lang(109) . "</a>" . "</thead>\n";
            $j = ($_GET["dbsize"] ? count_tables($j) : array_flip($j));foreach ($j as $k => $S) {
                $lf = h(ME) . "db=" . urlencode($k);
                echo "<tr" . odd() . ">" . (support("database") ? "<td>" . checkbox("db[]", $k, in_array($k, (array) $_POST["db"])) : ""), "<th><a href='$lf'>" . h($k) . "</a>";
                $Wa = nbsp(db_collation($k, $Xa));
                echo "<td>" . (support("database") ? "<a href='$lf" . ($sf ? "&amp;ns=" : "") . "&amp;database=' title='" . lang(55) . "'>$Wa</a>" : $Wa), "<td align='right'><a href='$lf&amp;schema=' id='tables-" . h($k) . "' title='" . lang(58) . "'>" . ($_GET["dbsize"] ? $S : "?") . "</a>", "<td align='right' id='size-" . h($k) . "'>" . ($_GET["dbsize"] ? db_size($k) : "?"), "\n";}
            echo "</table>\n", (support("database") ? "<fieldset><legend>" . lang(110) . " <span id='selected'></span></legend><div>\n" . "<input type='hidden' name='all' value='' onclick=\"selectCount('selected', formChecked(this, /^db/));\">\n" . "<input type='submit' name='drop' value='" . lang(111) . "'" . confirm() . ">\n" . "</div></fieldset>\n" : ""), "<script type='text/javascript'>tableCheck();</script>\n", "<input type='hidden' name='token' value='$T'>\n", "</form>\n";}}
    page_footer("db");}if (isset($_GET["status"])) {
    $_GET["variables"] = $_GET["status"];
}
if (isset($_GET["import"])) {
    $_GET["sql"] = $_GET["import"];
}
if (!(DB != "" ? $g->select_db(DB) : isset($_GET["sql"]) || isset($_GET["dump"]) || isset($_GET["database"]) || isset($_GET["processlist"]) || isset($_GET["privileges"]) || isset($_GET["user"]) || isset($_GET["variables"]) || $_GET["script"] == "connect" || $_GET["script"] == "kill")) {
    if (DB != "" || $_GET["refresh"]) {restart_session();
        set_session("dbs", null);}
    connect_error();exit;}
$Zd = "RESTRICT|NO ACTION|CASCADE|SET NULL|SET DEFAULT";class
TmpFile
{
    public $handler;public $size;public function
    TmpFile() {$this->handler = tmpfile();}public function
    write($gb) {
        $this->size += strlen($gb);
        fwrite($this->handler, $gb);}public function
    send() {
        fseek($this->handler, 0);
        fpassthru($this->handler);
        fclose($this->handler);}}$Vb = "'(?:''|[^'\\\\]|\\\\.)*'";
$Pc                          = "IN|OUT|INOUT";if (isset($_GET["select"]) && ($_POST["edit"] || $_POST["clone"]) && !$_POST["save"]) {
    $_GET["edit"] = $_GET["select"];
}
if (isset($_GET["callf"])) {
    $_GET["call"] = $_GET["callf"];
}
if (isset($_GET["function"])) {
    $_GET["procedure"] = $_GET["function"];
}
if (isset($_GET["download"])) {
    $b = $_GET["download"];
    $o = fields($b);
    header("Content-Type: application/octet-stream");
    header("Content-Disposition: attachment; filename=" . friendly_url("$b-" . implode("_", $_GET["where"])) . "." . friendly_url($_GET["field"]));
    $N = array(idf_escape($_GET["field"]));
    $J = $l->select($b, $N, array(where($_GET, $o)), $N);
    $L = ($J ? $J->fetch_row() : array());
    echo $L[0];exit;} elseif (isset($_GET["table"])) {
    $b = $_GET["table"];
    $o = fields($b);if (!$o) {
        $m = error();
    }

    $R = table_status1($b, true);
    page_header(($o && is_view($R) ? lang(112) : lang(113)) . ": " . h($b), $m);
    $c->selectLinks($R);
    $bb = $R["Comment"];if ($bb != "") {
        echo "<p>" . lang(91) . ": " . h($bb) . "\n";
    }
    if ($o) {
        echo "<table cellspacing='0'>\n", "<thead><tr><th>" . lang(114) . "<td>" . lang(87) . (support("comment") ? "<td>" . lang(91) : "") . "</thead>\n";foreach ($o as $n) {echo "<tr" . odd() . "><th>" . h($n["field"]), "<td><span title='" . h($n["collation"]) . "'>" . h($n["full_type"]) . "</span>", ($n["null"] ? " <i>NULL</i>" : ""), ($n["auto_increment"] ? " <i>" . lang(52) . "</i>" : ""), (isset($n["default"]) ? " <span title='" . lang(90) . "'>[<b>" . h($n["default"]) . "</b>]</span>" : ""), (support("comment") ? "<td>" . nbsp($n["comment"]) : ""), "\n";}
        echo "</table>\n";}if (!is_view($R)) {
        if (support("indexes")) {echo "<h3 id='indexes'>" . lang(115) . "</h3>\n";
            $x = indexes($b);if ($x) {
                echo "<table cellspacing='0'>\n";foreach ($x as $F => $w) {
                    ksort($w["columns"]);
                    $Me = array();foreach ($w["columns"] as $z => $X) {
                        $Me[] = "<i>" . h($X) . "</i>" . ($w["lengths"][$z] ? "(" . $w["lengths"][$z] . ")" : "") . ($w["descs"][$z] ? " DESC" : "");
                    }

                    echo "<tr title='" . h($F) . "'><th>$w[type]<td>" . implode(", ", $Me) . "\n";}
                echo "</table>\n";}
            echo '<p class="links"><a href="' . h(ME) . 'indexes=' . urlencode($b) . '">' . lang(116) . "</a>\n";}if (fk_support($R)) {
            echo "<h3 id='foreign-keys'>" . lang(81) . "</h3>\n";
            $q = foreign_keys($b);if ($q) {
                echo "<table cellspacing='0'>\n", "<thead><tr><th>" . lang(117) . "<td>" . lang(118) . "<td>" . lang(84) . "<td>" . lang(83) . "<td>&nbsp;</thead>\n";foreach ($q as $F => $p) {echo "<tr title='" . h($F) . "'>", "<th><i>" . implode("</i>, <i>", array_map('h', $p["source"])) . "</i>", "<td><a href='" . h($p["db"] != "" ? preg_replace('~db=[^&]*~', "db=" . urlencode($p["db"]), ME) : ($p["ns"] != "" ? preg_replace('~ns=[^&]*~', "ns=" . urlencode($p["ns"]), ME) : ME)) . "table=" . urlencode($p["table"]) . "'>" . ($p["db"] != "" ? "<b>" . h($p["db"]) . "</b>." : "") . ($p["ns"] != "" ? "<b>" . h($p["ns"]) . "</b>." : "") . h($p["table"]) . "</a>", "(<i>" . implode("</i>, <i>", array_map('h', $p["target"])) . "</i>)", "<td>" . nbsp($p["on_delete"]) . "\n", "<td>" . nbsp($p["on_update"]) . "\n", '<td><a href="' . h(ME . 'foreign=' . urlencode($b) . '&name=' . urlencode($F)) . '">' . lang(119) . '</a>';}
                echo "</table>\n";}
            echo '<p class="links"><a href="' . h(ME) . 'foreign=' . urlencode($b) . '">' . lang(120) . "</a>\n";}}if (support(is_view($R) ? "view_trigger" : "trigger")) {
        echo "<h3 id='triggers'>" . lang(121) . "</h3>\n";
        $tg = triggers($b);if ($tg) {
            echo "<table cellspacing='0'>\n";foreach ($tg as $z => $X) {
                echo "<tr valign='top'><td>" . h($X[0]) . "<td>" . h($X[1]) . "<th>" . h($z) . "<td><a href='" . h(ME . 'trigger=' . urlencode($b) . '&name=' . urlencode($z)) . "'>" . lang(119) . "</a>\n";
            }

            echo "</table>\n";}
        echo '<p class="links"><a href="' . h(ME) . 'trigger=' . urlencode($b) . '">' . lang(122) . "</a>\n";}} elseif (isset($_GET["schema"])) {
    page_header(lang(58), "", array(), h(DB . ($_GET["ns"] ? ".$_GET[ns]" : "")));
    $Tf = array();
    $Uf = array();
    $da = ($_GET["schema"] ? $_GET["schema"] : $_COOKIE["adminer_schema-" . str_replace(".", "_", DB)]);
    preg_match_all('~([^:]+):([-0-9.]+)x([-0-9.]+)(_|$)~', $da, $vd, PREG_SET_ORDER);foreach ($vd as $v => $C) {
        $Tf[$C[1]] = array($C[2], $C[3]);
        $Uf[]      = "\n\t'" . js_escape($C[1]) . "': [ $C[2], $C[3] ]";}
    $ng = 0;
    $Ca = -1;
    $rf = array();
    $cf = array();
    $md = array();foreach (table_status('', true) as $Q => $R) {
        if (is_view($R)) {
            continue;
        }

        $Fe               = 0;
        $rf[$Q]["fields"] = array();foreach (fields($Q) as $F => $n) {
            $Fe += 1.25;
            $n["pos"]             = $Fe;
            $rf[$Q]["fields"][$F] = $n;}
        $rf[$Q]["pos"] = ($Tf[$Q] ? $Tf[$Q] : array($ng, 0));foreach ($c->foreignKeys($Q) as $X) {
            if (!$X["db"]) {$kd = $Ca;if ($Tf[$Q][1] || $Tf[$X["table"]][1]) {
                $kd = min(floatval($Tf[$Q][1]), floatval($Tf[$X["table"]][1])) - 1;
            } else {
                $Ca -= .1;
            }
                while ($md[(string) $kd]) {
                    $kd -= .0001;
                }

                $rf[$Q]["references"][$X["table"]][(string) $kd] = array($X["source"], $X["target"]);
                $cf[$X["table"]][$Q][(string) $kd]               = $X["target"];
                $md[(string) $kd]                                = true;}}
        $ng = max($ng, $rf[$Q]["pos"][0] + 2.5 + $Fe);}
    echo '<div id="schema" style="height: ', $ng, 'em;" onselectstart="return false;">
<script type="text/javascript">
var tablePos = {', implode(",", $Uf) . "\n", '};
var em = document.getElementById(\'schema\').offsetHeight / ', $ng, ';
document.onmousemove = schemaMousemove;
document.onmouseup = function (ev) {
	schemaMouseup(ev, \'', js_escape(DB), '\');
};
</script>
';foreach ($rf as $F => $Q) {
        echo "<div class='table' style='top: " . $Q["pos"][0] . "em; left: " . $Q["pos"][1] . "em;' onmousedown='schemaMousedown(this, event);'>", '<a href="' . h(ME) . 'table=' . urlencode($F) . '"><b>' . h($F) . "</b></a>";foreach ($Q["fields"] as $n) {$X = '<span' . type_class($n["type"]) . ' title="' . h($n["full_type"] . ($n["null"] ? " NULL" : '')) . '">' . h($n["field"]) . '</span>';
            echo "<br>" . ($n["primary"] ? "<i>$X</i>" : $X);}
        foreach ((array) $Q["references"] as $Zf => $df) {
            foreach ($df as $kd => $Ze) {
                $ld = $kd - $Tf[$F][1];
                $v  = 0;foreach ($Ze[0] as $Cf) {
                    echo "\n<div class='references' title='" . h($Zf) . "' id='refs$kd-" . ($v++) . "' style='left: $ld" . "em; top: " . $Q["fields"][$Cf]["pos"] . "em; padding-top: .5em;'><div style='border-top: 1px solid Gray; width: " . (-$ld) . "em;'></div></div>";
                }
            }}
        foreach ((array) $cf[$F] as $Zf => $df) {
            foreach ($df as $kd => $e) {
                $ld = $kd - $Tf[$F][1];
                $v  = 0;foreach ($e as $Yf) {
                    echo "\n<div class='references' title='" . h($Zf) . "' id='refd$kd-" . ($v++) . "' style='left: $ld" . "em; top: " . $Q["fields"][$Yf]["pos"] . "em; height: 1.25em; background: url(" . h(preg_replace("~\\?.*~", "", ME)) . "?file=arrow.gif) no-repeat right center;&amp;version=4.2.1&amp;driver=mysql'><div style='height: .5em; border-bottom: 1px solid Gray; width: " . (-$ld) . "em;'></div></div>";
                }
            }}
        echo "\n</div>\n";}
    foreach ($rf as $F => $Q) {
        foreach ((array) $Q["references"] as $Zf => $df) {foreach ($df as $kd => $Ze) {
            $Gd = $ng;
            $zd = -10;foreach ($Ze[0] as $z => $Cf) {
                $Ge = $Q["pos"][0] + $Q["fields"][$Cf]["pos"];
                $He = $rf[$Zf]["pos"][0] + $rf[$Zf]["fields"][$Ze[1][$z]]["pos"];
                $Gd = min($Gd, $Ge, $He);
                $zd = max($zd, $Ge, $He);}
            echo "<div class='references' id='refl$kd' style='left: $kd" . "em; top: $Gd" . "em; padding: .5em 0;'><div style='border-right: 1px solid Gray; margin-top: 1px; height: " . ($zd - $Gd) . "em;'></div></div>\n";}}}
    echo '</div>
<p class="links"><a href="', h(ME . "schema=" . urlencode($da)), '" id="schema-link">', lang(123), '</a>
';} elseif (isset($_GET["dump"])) {
    $b = $_GET["dump"];if ($_POST && !$m) {$jb = "";foreach (array("output", "format", "db_style", "routines", "events", "table_style", "auto_increment", "triggers", "data_style") as $z) {
        $jb .= "&$z=" . urlencode($_POST[$z]);
    }

        cookie("adminer_export", substr($jb, 1));
        $S  = array_flip((array) $_POST["tables"]) + array_flip((array) $_POST["data"]);
        $gc = dump_headers((count($S) == 1 ? key($S) : DB), (DB == "" || count($S) > 1));
        $Xc = preg_match('~sql~', $_POST["format"]);if ($Xc) {
            echo "-- Adminer $fa " . $Eb[DRIVER] . " dump\n\n";if ($y == "sql") {echo "SET NAMES utf8;
SET time_zone = '+00:00';
" . ($_POST["data_style"] ? "SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';
" : "") . "
";
                $g->query("SET time_zone = '+00:00';");}}
        $Lf = $_POST["db_style"];
        $j  = array(DB);if (DB == "") {
            $j = $_POST["databases"];if (is_string($j)) {
                $j = explode("\n", rtrim(str_replace("\r", "", $j), "\n"));
            }
        }
        foreach ((array) $j as $k) {
            $c->dumpDatabase($k);if ($g->select_db($k)) {if ($Xc && preg_match('~CREATE~', $Lf) && ($i = $g->result("SHOW CREATE DATABASE " . idf_escape($k), 1))) {set_utf8mb4($i);if ($Lf == "DROP+CREATE") {
                echo "DROP DATABASE IF EXISTS " . idf_escape($k) . ";\n";
            }

                echo "$i;\n";}if ($Xc) {
                if ($Lf) {
                    echo
                    use_sql($k) . ";\n\n";
                }

                $pe = "";if ($_POST["routines"]) {
                    foreach (array("FUNCTION", "PROCEDURE") as $mf) {foreach (get_rows("SHOW $mf STATUS WHERE Db = " . q($k), null, "-- ") as $L) {$i = remove_definer($g->result("SHOW CREATE $mf " . idf_escape($L["Name"]), 2));
                        set_utf8mb4($i);
                        $pe .= ($Lf != 'DROP+CREATE' ? "DROP $mf IF EXISTS " . idf_escape($L["Name"]) . ";;\n" : "") . "$i;;\n\n";}}}if ($_POST["events"]) {
                    foreach (get_rows("SHOW EVENTS", null, "-- ") as $L) {$i = remove_definer($g->result("SHOW CREATE EVENT " . idf_escape($L["Name"]), 3));
                        set_utf8mb4($i);
                        $pe .= ($Lf != 'DROP+CREATE' ? "DROP EVENT IF EXISTS " . idf_escape($L["Name"]) . ";;\n" : "") . "$i;;\n\n";}}if ($pe) {
                    echo "DELIMITER ;;\n\n$pe" . "DELIMITER ;\n\n";
                }
            }if ($_POST["table_style"] || $_POST["data_style"]) {
                $Og = array();foreach (table_status('', true) as $F => $R) {$Q = (DB == "" || in_array($F, (array) $_POST["tables"]));
                    $ob                           = (DB == "" || in_array($F, (array) $_POST["data"]));if ($Q || $ob) {
                        if ($gc == "tar") {$lg = new
                                TmpFile;
                            ob_start(array($lg, 'write'), 1e5);}
                        $c->dumpTable($F, ($Q ? $_POST["table_style"] : ""), (is_view($R) ? 2 : 0));if (is_view($R)) {
                            $Og[] = $F;
                        } elseif ($ob) {
                            $o = fields($F);
                            $c->dumpData($F, $_POST["data_style"], "SELECT *" . convert_fields($o, $o) . " FROM " . table($F));}if ($Xc && $_POST["triggers"] && $Q && ($tg = trigger_sql($F, $_POST["table_style"]))) {
                            echo "\nDELIMITER ;;\n$tg\nDELIMITER ;\n";
                        }
                        if ($gc == "tar") {
                            ob_end_flush();
                            tar_file((DB != "" ? "" : "$k/") . "$F.csv", $lg);} elseif ($Xc) {
                            echo "\n";
                        }
                    }}
                foreach ($Og as $Ng) {
                    $c->dumpTable($Ng, $_POST["table_style"], 1);
                }
                if ($gc == "tar") {
                    echo
                    pack("x512");
                }
            }}}if ($Xc) {
            echo "-- " . $g->result("SELECT NOW()") . "\n";
        }
        exit;}
    page_header(lang(61), $m, ($_GET["export"] != "" ? array("table" => $_GET["export"]) : array()), h(DB));
    echo '
<form action="" method="post">
<table cellspacing="0">
';
    $sb = array('', 'USE', 'DROP+CREATE', 'CREATE');
    $Vf = array('', 'DROP+CREATE', 'CREATE');
    $pb = array('', 'TRUNCATE+INSERT', 'INSERT');if ($y == "sql") {
        $pb[] = 'INSERT+UPDATE';
    }

    parse_str($_COOKIE["adminer_export"], $L);if (!$L) {
        $L = array("output" => "text", "format" => "sql", "db_style" => (DB != "" ? "" : "CREATE"), "table_style" => "DROP+CREATE", "data_style" => "INSERT");
    }
    if (!isset($L["events"])) {
        $L["routines"] = $L["events"] = ($_GET["dump"] == "");
        $L["triggers"] = $L["table_style"];}
    echo "<tr><th>" . lang(124) . "<td>" . html_select("output", $c->dumpOutput(), $L["output"], 0) . "\n";
    echo "<tr><th>" . lang(125) . "<td>" . html_select("format", $c->dumpFormat(), $L["format"], 0) . "\n";
    echo ($y == "sqlite" ? "" : "<tr><th>" . lang(31) . "<td>" . html_select('db_style', $sb, $L["db_style"]) . (support("routine") ? checkbox("routines", 1, $L["routines"], lang(126)) : "") . (support("event") ? checkbox("events", 1, $L["events"], lang(127)) : "")), "<tr><th>" . lang(107) . "<td>" . html_select('table_style', $Vf, $L["table_style"]) . checkbox("auto_increment", 1, $L["auto_increment"], lang(52)) . (support("trigger") ? checkbox("triggers", 1, $L["triggers"], lang(121)) : ""), "<tr><th>" . lang(128) . "<td>" . html_select('data_style', $pb, $L["data_style"]), '</table>
<p><input type="submit" value="', lang(61), '">
<input type="hidden" name="token" value="', $T, '">

<table cellspacing="0">
';
    $Ke = array();if (DB != "") {
        $Na = ($b != "" ? "" : " checked");
        echo "<thead><tr>", "<th style='text-align: left;'><label class='block'><input type='checkbox' id='check-tables'$Na onclick='formCheck(this, /^tables\\[/);'>" . lang(107) . "</label>", "<th style='text-align: right;'><label class='block'>" . lang(128) . "<input type='checkbox' id='check-data'$Na onclick='formCheck(this, /^data\\[/);'></label>", "</thead>\n";
        $Og = "";
        $Wf = tables_list();foreach ($Wf as $F => $U) {
            $Je = preg_replace('~_.*~', '', $F);
            $Na = ($b == "" || $b == (substr($b, -1) == "%" ? "$Je%" : $F));
            $Me = "<tr><td>" . checkbox("tables[]", $F, $Na, $F, "checkboxClick(event, this); formUncheck('check-tables');", "block");if ($U !== null && !preg_match('~table~i', $U)) {
                $Og .= "$Me\n";
            } else {
                echo "$Me<td align='right'><label class='block'><span id='Rows-" . h($F) . "'></span>" . checkbox("data[]", $F, $Na, "", "checkboxClick(event, this); formUncheck('check-data');") . "</label>\n";
            }

            $Ke[$Je]++;}
        echo $Og;if ($Wf) {
            echo "<script type='text/javascript'>ajaxSetHtml('" . js_escape(ME) . "script=db');</script>\n";
        }
    } else {
        echo "<thead><tr><th style='text-align: left;'><label class='block'><input type='checkbox' id='check-databases'" . ($b == "" ? " checked" : "") . " onclick='formCheck(this, /^databases\\[/);'>" . lang(31) . "</label></thead>\n";
        $j = $c->databases();if ($j) {
            foreach ($j as $k) {
                if (!information_schema($k)) {$Je = preg_replace('~_.*~', '', $k);
                    echo "<tr><td>" . checkbox("databases[]", $k, $b == "" || $b == "$Je%", $k, "formUncheck('check-databases');", "block") . "\n";
                    $Ke[$Je]++;}}} else {
            echo "<tr><td><textarea name='databases' rows='10' cols='20'></textarea>";
        }
    }
    echo '</table>
</form>
';
    $pc = true;foreach ($Ke as $z => $X) {
        if ($z != "" && $X > 1) {echo ($pc ? "<p>" : " ") . "<a href='" . h(ME) . "dump=" . urlencode("$z%") . "'>" . h($z) . "</a>";
            $pc = false;}}} elseif (isset($_GET["privileges"])) {
    page_header(lang(59));
    $J = $g->query("SELECT User, Host FROM mysql." . (DB == "" ? "user" : "db WHERE " . q(DB) . " LIKE Db") . " ORDER BY Host, User");
    $t = $J;if (!$J) {
        $J = $g->query("SELECT SUBSTRING_INDEX(CURRENT_USER, '@', 1) AS User, SUBSTRING_INDEX(CURRENT_USER, '@', -1) AS Host");
    }

    echo "<form action=''><p>\n";
    hidden_fields_get();
    echo "<input type='hidden' name='db' value='" . h(DB) . "'>\n", ($t ? "" : "<input type='hidden' name='grant' value=''>\n"), "<table cellspacing='0'>\n", "<thead><tr><th>" . lang(29) . "<th>" . lang(28) . "<th>&nbsp;</thead>\n";while ($L = $J->fetch_assoc()) {
        echo '<tr' . odd() . '><td>' . h($L["User"]) . "<td>" . h($L["Host"]) . '<td><a href="' . h(ME . 'user=' . urlencode($L["User"]) . '&host=' . urlencode($L["Host"])) . '">' . lang(10) . "</a>\n";
    }
    if (!$t || DB != "") {
        echo "<tr" . odd() . "><td><input name='user' autocapitalize='off'><td><input name='host' value='localhost' autocapitalize='off'><td><input type='submit' value='" . lang(10) . "'>\n";
    }

    echo "</table>\n", "</form>\n", '<p class="links"><a href="' . h(ME) . 'user=">' . lang(129) . "</a>";} elseif (isset($_GET["sql"])) {
    if (!$m && $_POST["export"]) {dump_headers("sql");
        $c->dumpTable("", "");
        $c->dumpData("", "table", $_POST["query"]);exit;}
    restart_session();
    $Fc = &get_session("queries");
    $Ec = &$Fc[DB];if (!$m && $_POST["clear"]) {
        $Ec = array();
        redirect(remove_from_uri("history"));}
    page_header((isset($_GET["import"]) ? lang(60) : lang(51)), $m);if (!$m && $_POST) {
        $r = false;if (!isset($_GET["import"])) {
            $I = $_POST["query"];
        } elseif ($_POST["webfile"]) {
            $r = @fopen((file_exists("adminer.sql") ? "adminer.sql" : "compress.zlib://adminer.sql.gz"), "rb");
            $I = ($r ? fread($r, 1e6) : false);} else {
            $I = get_file("sql_file", true);
        }
        if (is_string($I)) {
            if (function_exists('memory_get_usage')) {
                @ini_set("memory_limit", max(ini_bytes("memory_limit"), 2 * strlen($I) + memory_get_usage() + 8e6));
            }
            if ($I != "" && strlen($I) < 1e6) {
                $H = $I . (preg_match("~;[ \t\r\n]*\$~", $I) ? "" : ";");if (!$Ec || reset(end($Ec)) != $H) {restart_session();
                    $Ec[] = array($H, time());
                    set_session("queries", $Fc);
                    stop_session();}}
            $Df = "(?:\\s|/\\*.*\\*/|(?:#|-- )[^\n]*\n|--\r?\n)";
            $wb = ";";
            $Sd = 0;
            $Sb = true;
            $h  = connect();if (is_object($h) && DB != "") {
                $h->select_db(DB);
            }

            $ab = 0;
            $Xb = array();
            $rd = 0;
            $ue = '[\'"' . ($y == "sql" ? '`#' : ($y == "sqlite" ? '`[' : ($y == "mssql" ? '[' : ''))) . ']|/\\*|-- |$' . ($y == "pgsql" ? '|\\$[^$]*\\$' : '');
            $og = microtime(true);
            parse_str($_COOKIE["adminer_export"], $la);
            $Jb = $c->dumpFormat();unset($Jb["sql"]);while ($I != "") {
                if (!$Sd && preg_match("~^$Df*DELIMITER\\s+(\\S+)~i", $I, $C)) {$wb = $C[1];
                    $I                             = substr($I, strlen($C[0]));} else {
                    preg_match('(' . preg_quote($wb) . "\\s*|$ue)", $I, $C, PREG_OFFSET_CAPTURE, $Sd);list($uc, $Fe) = $C[0];if (!$uc && $r && !feof($r)) {
                        $I .= fread($r, 1e5);
                    } else {
                        if (!$uc && rtrim($I) == "") {
                            break;
                        }

                        $Sd = $Fe + strlen($uc);if ($uc && rtrim($uc) != $wb) {
                            while (preg_match('(' . ($uc == '/*' ? '\\*/' : ($uc == '[' ? ']' : (preg_match('~^-- |^#~', $uc) ? "\n" : preg_quote($uc) . "|\\\\."))) . '|$)s', $I, $C, PREG_OFFSET_CAPTURE, $Sd)) {$pf = $C[0][0];if (!$pf && $r && !feof($r)) {
                                $I .= fread($r, 1e5);
                            } else {
                                $Sd = $C[0][1] + strlen($pf);if ($pf[0] != "\\") {
                                    break;
                                }
                            }}} else {
                            $Sb = false;
                            $H  = substr($I, 0, $Fe);
                            $ab++;
                            $Me = "<pre id='sql-$ab'><code class='jush-$y'>" . shorten_utf8(trim($H), 1000) . "</code></pre>\n";if (!$_POST["only_errors"]) {
                                echo $Me;
                                ob_flush();
                                flush();}
                            $Ff = microtime(true);if ($g->multi_query($H) && is_object($h) && preg_match("~^$Df*USE\\b~isU", $H)) {
                                $h->query($H);
                            }
                            do {
                                $J  = $g->store_result();
                                $eg = " <span class='time'>(" . format_time($Ff) . ")</span>" . (strlen($H) < 1000 ? " <a href='" . h(ME) . "sql=" . urlencode(trim($H)) . "'>" . lang(10) . "</a>" : "");if ($g->error) {
                                    echo ($_POST["only_errors"] ? $Me : ""), "<p class='error'>" . lang(130) . ($g->errno ? " ($g->errno)" : "") . ": " . error() . "\n";
                                    $Xb[] = " <a href='#sql-$ab'>$ab</a>";if ($_POST["error_stops"]) {
                                        break
                                            2;
                                    }
                                } elseif (is_object($J)) {
                                    $_  = $_POST["limit"];
                                    $ke = select($J, $h, array(), $_);if (!$_POST["only_errors"]) {
                                        echo "<form action='' method='post'>\n";
                                        $Pd = $J->num_rows;
                                        echo "<p>" . ($Pd ? ($_ && $Pd > $_ ? lang(131, $_) : "") . lang(132, $Pd) : ""), $eg;
                                        $Ic = "export-$ab";
                                        $fc = ", <a href='#$Ic' onclick=\"return !toggle('$Ic');\">" . lang(61) . "</a><span id='$Ic' class='hidden'>: " . html_select("output", $c->dumpOutput(), $la["output"]) . " " . html_select("format", $Jb, $la["format"]) . "<input type='hidden' name='query' value='" . h($H) . "'>" . " <input type='submit' name='export' value='" . lang(61) . "'><input type='hidden' name='token' value='$T'></span>\n";if ($h && preg_match("~^($Df|\\()*SELECT\\b~isU", $H) && ($ec = explain($h, $H))) {
                                            $Ic = "explain-$ab";
                                            echo ", <a href='#$Ic' onclick=\"return !toggle('$Ic');\">EXPLAIN</a>$fc", "<div id='$Ic' class='hidden'>\n";
                                            select($ec, $h, $ke);
                                            echo "</div>\n";} else {
                                            echo $fc;
                                        }

                                        echo "</form>\n";}} else {
                                    if (preg_match("~^$Df*(CREATE|DROP|ALTER)$Df+(DATABASE|SCHEMA)\\b~isU", $H)) {restart_session();
                                        set_session("dbs", null);
                                        stop_session();}if (!$_POST["only_errors"]) {
                                        echo "<p class='message' title='" . h($g->info) . "'>" . lang(133, $g->affected_rows) . "$eg\n";
                                    }
                                }
                                $Ff = microtime(true);} while ($g->next_result());
                            $rd += substr_count($H . $uc, "\n");
                            $I  = substr($I, $Sd);
                            $Sd = 0;}}}}if ($Sb) {
                echo "<p class='message'>" . lang(134) . "\n";
            } elseif ($_POST["only_errors"]) {echo "<p class='message'>" . lang(135, $ab - count($Xb)), " <span class='time'>(" . format_time($og) . ")</span>\n";} elseif ($Xb && $ab > 1) {
                echo "<p class='error'>" . lang(130) . ": " . implode("", $Xb) . "\n";
            }
        } else {
            echo "<p class='error'>" . upload_error($I) . "\n";
        }
    }
    echo '
<form action="" method="post" enctype="multipart/form-data" id="form">
';
    $cc = "<input type='submit' value='" . lang(136) . "' title='Ctrl+Enter'>";if (!isset($_GET["import"])) {
        $H = $_GET["sql"];if ($_POST) {
            $H = $_POST["query"];
        } elseif ($_GET["history"] == "all") {
            $H = $Ec;
        } elseif ($_GET["history"] != "") {
            $H = $Ec[$_GET["history"]][0];
        }

        echo "<p>";
        textarea("query", $H, 20);
        echo ($_POST ? "" : "<script type='text/javascript'>focus(document.getElementsByTagName('textarea')[0]);</script>\n"), "<p>$cc\n", lang(137) . ": <input type='number' name='limit' class='size' value='" . h($_POST ? $_POST["limit"] : $_GET["limit"]) . "'>\n";} else {echo "<fieldset><legend>" . lang(138) . "</legend><div>", (ini_bool("file_uploads") ? "SQL (&lt; " . ini_get("upload_max_filesize") . "B): <input type='file' name='sql_file[]' multiple>\n$cc" : lang(139)), "</div></fieldset>\n", "<fieldset><legend>" . lang(140) . "</legend><div>", lang(141, "<code>adminer.sql" . (extension_loaded("zlib") ? "[.gz]" : "") . "</code>"), ' <input type="submit" name="webfile" value="' . lang(142) . '">', "</div></fieldset>\n", "<p>";}
    echo
    checkbox("error_stops", 1, ($_POST ? $_POST["error_stops"] : isset($_GET["import"])), lang(143)) . "\n", checkbox("only_errors", 1, ($_POST ? $_POST["only_errors"] : isset($_GET["import"])), lang(144)) . "\n", "<input type='hidden' name='token' value='$T'>\n";if (!isset($_GET["import"]) && $Ec) {
        print_fieldset("history", lang(145), $_GET["history"] != "");for ($X = end($Ec); $X; $X = prev($Ec)) {$z = key($Ec);list($H, $eg, $Nb) = $X;
            echo '<a href="' . h(ME . "sql=&history=$z") . '">' . lang(10) . "</a>" . " <span class='time' title='" . @date('Y-m-d', $eg) . "'>" . @date("H:i:s", $eg) . "</span>" . " <code class='jush-$y'>" . shorten_utf8(ltrim(str_replace("\n", " ", str_replace("\r", "", preg_replace('~^(#|-- ).*~m', '', $H)))), 80, "</code>") . ($Nb ? " <span class='time'>($Nb)</span>" : "") . "<br>\n";}
        echo "<input type='submit' name='clear' value='" . lang(146) . "'>\n", "<a href='" . h(ME . "sql=&history=all") . "'>" . lang(147) . "</a>\n", "</div></fieldset>\n";}
    echo '</form>
';} elseif (isset($_GET["edit"])) {
    $b  = $_GET["edit"];
    $o  = fields($b);
    $Z  = (isset($_GET["select"]) ? (count($_POST["check"]) == 1 ? where_check($_POST["check"][0], $o) : "") : where($_GET, $o));
    $Dg = (isset($_GET["select"]) ? $_POST["edit"] : $Z);foreach ($o as $F => $n) {
        if (!isset($n["privileges"][$Dg ? "update" : "insert"]) || $c->fieldName($n) == "") {
            unset($o[$F]);
        }
    }if ($_POST && !$m && !isset($_GET["select"])) {
        $B = $_POST["referer"];if ($_POST["insert"]) {
            $B = ($Dg ? null : $_SERVER["REQUEST_URI"]);
        } elseif (!preg_match('~^.+&select=.+$~', $B)) {
            $B = ME . "select=" . urlencode($b);
        }

        $x  = indexes($b);
        $zg = unique_array($_GET["where"], $x);
        $Ve = "\nWHERE $Z";if (isset($_POST["delete"])) {
            queries_redirect($B, lang(148), $l->delete($b, $Ve, !$zg));
        } else {
            $P = array();foreach ($o as $F => $n) {
                $X = process_input($n);if ($X !== false && $X !== null) {
                    $P[idf_escape($F)] = $X;
                }
            }if ($Dg) {
                if (!$P) {
                    redirect($B);
                }

                queries_redirect($B, lang(149), $l->update($b, $P, $Ve, !$zg));if (is_ajax()) {
                    page_headers();
                    page_messages($m);exit;}} else {
                $J  = $l->insert($b, $P);
                $jd = ($J ? last_id() : 0);
                queries_redirect($B, lang(150, ($jd ? " $jd" : "")), $J);}}}
    $L = null;if ($_POST["save"]) {
        $L = (array) $_POST["fields"];
    } elseif ($Z) {
        $N = array();foreach ($o as $F => $n) {
            if (isset($n["privileges"]["select"])) {$ua = convert_field($n);if ($_POST["clone"] && $n["auto_increment"]) {
                $ua = "''";
            }
                if ($y == "sql" && preg_match("~enum|set~", $n["type"])) {
                    $ua = "1*" . idf_escape($F);
                }

                $N[] = ($ua ? "$ua AS " : "") . idf_escape($F);}}
        $L = array();if (!support("table")) {
            $N = array("*");
        }
        if ($N) {
            $J = $l->select($b, $N, array($Z), $N, array(), (isset($_GET["select"]) ? 2 : 1));
            $L = $J->fetch_assoc();if (!$L) {
                $L = false;
            }
            if (isset($_GET["select"]) && (!$L || $J->fetch_assoc())) {
                $L = null;
            }
        }}if (!support("table") && !$o) {
        if (!$Z) {$J = $l->select($b, array("*"), $Z, array("*"));
            $L                            = ($J ? $J->fetch_assoc() : false);if (!$L) {
                $L = array($l->primary => "");
            }
        }if ($L) {
            foreach ($L as $z => $X) {
                if (!$Z) {
                    $L[$z] = null;
                }

                $o[$z] = array("field" => $z, "null" => ($z != $l->primary), "auto_increment" => ($z == $l->primary));}}}
    edit_form($b, $o, $L, $Dg);} elseif (isset($_GET["create"])) {
    $b  = $_GET["create"];
    $ve = array();foreach (array('HASH', 'LINEAR HASH', 'KEY', 'LINEAR KEY', 'RANGE', 'LIST') as $z) {
        $ve[$z] = $z;
    }

    $bf = referencable_primary($b);
    $q  = array();foreach ($bf as $Sf => $n) {
        $q[str_replace("`", "``", $Sf) . "`" . str_replace("`", "``", $n["field"])] = $Sf;
    }

    $ne = array();
    $R  = array();if ($b != "") {
        $ne = fields($b);
        $R  = table_status($b);if (!$R) {
            $m = lang(9);
        }
    }
    $L           = $_POST;
    $L["fields"] = (array) $L["fields"];if ($L["auto_increment_col"]) {
        $L["fields"][$L["auto_increment_col"]]["auto_increment"] = true;
    }
    if ($_POST && !process_fields($L["fields"]) && !$m) {
        if ($_POST["drop"]) {
            queries_redirect(substr(ME, 0, -1), lang(151), drop_tables(array($b)));
        } else {
            $o  = array();
            $ra = array();
            $Gg = false;
            $rc = array();
            ksort($L["fields"]);
            $me = reset($ne);
            $pa = " FIRST";foreach ($L["fields"] as $z => $n) {
                $p  = $q[$n["type"]];
                $ug = ($p !== null ? $bf[$p] : $n);if ($n["field"] != "") {
                    if (!$n["has_default"]) {
                        $n["default"] = null;
                    }
                    if ($z == $L["auto_increment_col"]) {
                        $n["auto_increment"] = true;
                    }

                    $Re   = process_field($n, $ug);
                    $ra[] = array($n["orig"], $Re, $pa);if ($Re != process_field($me, $me)) {
                        $o[] = array($n["orig"], $Re, $pa);if ($n["orig"] != "" || $pa) {
                            $Gg = true;
                        }
                    }if ($p !== null) {
                        $rc[idf_escape($n["field"])] = ($b != "" && $y != "sqlite" ? "ADD" : " ") . format_foreign_key(array('table' => $q[$n["type"]], 'source' => array($n["field"]), 'target' => array($ug["field"]), 'on_delete' => $n["on_delete"]));
                    }

                    $pa = " AFTER " . idf_escape($n["field"]);} elseif ($n["orig"] != "") {
                    $Gg  = true;
                    $o[] = array($n["orig"]);}if ($n["orig"] != "") {
                    $me = next($ne);if (!$me) {
                        $pa = "";
                    }
                }}
            $xe = "";if ($ve[$L["partition_by"]]) {
                $ye = array();if ($L["partition_by"] == 'RANGE' || $L["partition_by"] == 'LIST') {foreach (array_filter($L["partition_names"]) as $z => $X) {$Y = $L["partition_values"][$z];
                    $ye[]                         = "\n  PARTITION " . idf_escape($X) . " VALUES " . ($L["partition_by"] == 'RANGE' ? "LESS THAN" : "IN") . ($Y != "" ? " ($Y)" : " MAXVALUE");}}
                $xe .= "\nPARTITION BY $L[partition_by]($L[partition])" . ($ye ? " (" . implode(",", $ye) . "\n)" : ($L["partitions"] ? " PARTITIONS " . (+$L["partitions"]) : ""));} elseif (support("partitioning") && preg_match("~partitioned~", $R["Create_options"])) {
                $xe .= "\nREMOVE PARTITIONING";
            }

            $D = lang(152);if ($b == "") {
                cookie("adminer_engine", $L["Engine"]);
                $D = lang(153);}
            $F = trim($L["name"]);
            queries_redirect(ME . (support("table") ? "table=" : "select=") . urlencode($F), $D, alter_table($b, $F, ($y == "sqlite" && ($Gg || $rc) ? $ra : $o), $rc, ($L["Comment"] != $R["Comment"] ? $L["Comment"] : null), ($L["Engine"] && $L["Engine"] != $R["Engine"] ? $L["Engine"] : ""), ($L["Collation"] && $L["Collation"] != $R["Collation"] ? $L["Collation"] : ""), ($L["Auto_increment"] != "" ? number($L["Auto_increment"]) : ""), $xe));}}
    page_header(($b != "" ? lang(37) : lang(62)), $m, array("table" => $b), h($b));if (!$_POST) {
        $L = array("Engine" => $_COOKIE["adminer_engine"], "fields" => array(array("field" => "", "type" => (isset($wg["int"]) ? "int" : (isset($wg["integer"]) ? "integer" : "")))), "partition_names" => array(""));if ($b != "") {$L = $R;
            $L["name"]                    = $b;
            $L["fields"]                  = array();if (!$_GET["auto_increment"]) {
                $L["Auto_increment"] = "";
            }
            foreach ($ne as $n) {
                $n["has_default"] = isset($n["default"]);
                $L["fields"][]    = $n;}if (support("partitioning")) {
                $wc                    = "FROM information_schema.PARTITIONS WHERE TABLE_SCHEMA = " . q(DB) . " AND TABLE_NAME = " . q($b);
                $J                     = $g->query("SELECT PARTITION_METHOD, PARTITION_ORDINAL_POSITION, PARTITION_EXPRESSION $wc ORDER BY PARTITION_ORDINAL_POSITION DESC LIMIT 1");list($L["partition_by"], $L["partitions"], $L["partition"])                     = $J->fetch_row();
                $ye                    = get_key_vals("SELECT PARTITION_NAME, PARTITION_DESCRIPTION $wc AND PARTITION_NAME != '' ORDER BY PARTITION_ORDINAL_POSITION");
                $ye[""]                = "";
                $L["partition_names"]  = array_keys($ye);
                $L["partition_values"] = array_values($ye);}}}
    $Xa = collations();
    $Ub = engines();foreach ($Ub as $Tb) {
        if (!strcasecmp($Tb, $L["Engine"])) {$L["Engine"] = $Tb;
            break;}}
    echo '
<form action="" method="post" id="form">
<p>
';if (support("columns") || $b == "") {
        echo
        lang(154), ': <input name="name" maxlength="64" value="', h($L["name"]), '" autocapitalize="off">
';if ($b == "" && !$_POST) { ?><script type='text/javascript'>focus(document.getElementById('form')['name']);</script><?php }
        echo ($Ub ? "<select name='Engine' onchange='helpClose();'" . on_help("getTarget(event).value", 1) . ">" . optionlist(array("" => "(" . lang(155) . ")") + $Ub, $L["Engine"]) . "</select>" : ""), ' ', ($Xa && !preg_match("~sqlite|mssql~", $y) ? html_select("Collation", array("" => "(" . lang(82) . ")") + $Xa, $L["Collation"]) : ""), ' <input type="submit" value="', lang(14), '">
';}
    echo '
';if (support("columns")) {
        echo '<table cellspacing="0" id="edit-fields" class="nowrap">
';
        $cb = ($_POST ? $_POST["comments"] : $L["Comment"] != "");if (!$_POST && !$cb) {
            foreach ($L["fields"] as $n) {if ($n["comment"] != "") {$cb = true;
                break;}}}
        edit_fields($L["fields"], $Xa, "TABLE", $q, $cb);
        echo '</table>
<p>
', lang(52), ': <input type="number" name="Auto_increment" size="6" value="', h($L["Auto_increment"]), '">
', checkbox("defaults", 1, true, lang(156), "columnShow(this.checked, 5)", "jsonly");if (!$_POST["defaults"]) {echo '<script type="text/javascript">editingHideDefaults()</script>';}
        echo (support("comment") ? "<label><input type='checkbox' name='comments' value='1' class='jsonly' onclick=\"columnShow(this.checked, 6); toggle('Comment'); if (this.checked) this.form['Comment'].focus();\"" . ($cb ? " checked" : "") . ">" . lang(91) . "</label>" . ' <input name="Comment" id="Comment" value="' . h($L["Comment"]) . '" maxlength="' . ($g->server_info >= 5.5 ? 2048 : 60) . '"' . ($cb ? '' : ' class="hidden"') . '>' : ''), '<p>
<input type="submit" value="', lang(14), '">
';}
    echo '
';if ($b != "") {echo '<input type="submit" name="drop" value="', lang(111), '"', confirm(), '>';}if (support("partitioning")) {
        $we = preg_match('~RANGE|LIST~', $L["partition_by"]);
        print_fieldset("partition", lang(157), $L["partition_by"]);
        echo '<p>
', "<select name='partition_by' onchange='partitionByChange(this);'" . on_help("getTarget(event).value.replace(/./, 'PARTITION BY \$&')", 1) . ">" . optionlist(array("" => "") + $ve, $L["partition_by"]) . "</select>", '(<input name="partition" value="', h($L["partition"]), '">)
', lang(158), ': <input type="number" name="partitions" class="size', ($we || !$L["partition_by"] ? " hidden" : ""), '" value="', h($L["partitions"]), '">
<table cellspacing="0" id="partition-table"', ($we ? "" : " class='hidden'"), '>
<thead><tr><th>', lang(159), '<th>', lang(160), '</thead>
';foreach ($L["partition_names"] as $z => $X) {echo '<tr>', '<td><input name="partition_names[]" value="' . h($X) . '"' . ($z == count($L["partition_names"]) - 1 ? ' onchange="partitionNameChange(this);"' : '') . ' autocapitalize="off">', '<td><input name="partition_values[]" value="' . h($L["partition_values"][$z]) . '">';}
        echo '</table>
</div></fieldset>
';}
    echo '<input type="hidden" name="token" value="', $T, '">
</form>
';} elseif (isset($_GET["indexes"])) {
    $b  = $_GET["indexes"];
    $Nc = array("PRIMARY", "UNIQUE", "INDEX");
    $R  = table_status($b, true);if (preg_match('~MyISAM|M?aria' . ($g->server_info >= 5.6 ? '|InnoDB' : '') . '~i', $R["Engine"])) {
        $Nc[] = "FULLTEXT";
    }

    $x  = indexes($b);
    $Le = array();if ($y == "mongo") {$Le = $x["_id_"];unset($Nc[0]);unset($x["_id_"]);}
    $L  = $_POST;if ($_POST && !$m && !$_POST["add"] && !$_POST["drop_col"]) {
        $sa = array();foreach ($L["indexes"] as $w) {$F = $w["name"];if (in_array($w["type"], $Nc)) {$e = array();
            $pd                           = array();
            $yb                           = array();
            $P                            = array();
            ksort($w["columns"]);foreach ($w["columns"] as $z => $d) {
                if ($d != "") {$od = $w["lengths"][$z];
                    $xb                            = $w["descs"][$z];
                    $P[]                           = idf_escape($d) . ($od ? "(" . (+$od) . ")" : "") . ($xb ? " DESC" : "");
                    $e[]                           = $d;
                    $pd[]                          = ($od ? $od : null);
                    $yb[]                          = $xb;}}if ($e) {
                $dc = $x[$F];if ($dc) {ksort($dc["columns"]);
                    ksort($dc["lengths"]);
                    ksort($dc["descs"]);if ($w["type"] == $dc["type"] && array_values($dc["columns"]) === $e && (!$dc["lengths"] || array_values($dc["lengths"]) === $pd) && array_values($dc["descs"]) === $yb) {
                        unset($x[$F]);
                        continue;}}
                $sa[] = array($w["type"], $F, $P);}}}
        foreach ($x as $F => $dc) {
            $sa[] = array($dc["type"], $F, "DROP");
        }
        if (!$sa) {
            redirect(ME . "table=" . urlencode($b));
        }

        queries_redirect(ME . "table=" . urlencode($b), lang(161), alter_indexes($b, $sa));}
    page_header(lang(115), $m, array("table" => $b), h($b));
    $o = array_keys(fields($b));if ($_POST["add"]) {
        foreach ($L["indexes"] as $z => $w) {if ($w["columns"][count($w["columns"])] != "") {
            $L["indexes"][$z]["columns"][] = "";
        }
        }
        $w = end($L["indexes"]);if ($w["type"] || array_filter($w["columns"], 'strlen')) {
            $L["indexes"][] = array("columns" => array(1 => ""));
        }
    }if (!$L) {
        foreach ($x as $z => $w) {
            $x[$z]["name"]      = $z;
            $x[$z]["columns"][] = "";}
        $x[]          = array("columns" => array(1 => ""));
        $L["indexes"] = $x;}
    echo '
<form action="" method="post">
<table cellspacing="0" class="nowrap">
<thead><tr>
<th>', lang(162), '<th><input type="submit" style="left: -1000px; position: absolute;">', lang(163), '<th>', lang(164);?>
<th><noscript><input type='image' class='icon' name='add[0]' src='" . h(preg_replace("~\\?.*~", "", ME)) . "?file=plus.gif&amp;version=4.2.1&amp;driver=mysql' alt='+' title='<?php echo
    lang(92), '\'></noscript>&nbsp;
</thead>
';if ($Le) {
        echo "<tr><td>PRIMARY<td>";foreach ($Le["columns"] as $z => $d) {echo
            select_input(" disabled", $o, $d), "<label><input disabled type='checkbox'>" . lang(46) . "</label> ";}
        echo "<td><td>\n";}
    $ad = 1;foreach ($L["indexes"] as $w) {
        if (!$_POST["drop_col"] || $ad != key($_POST["drop_col"])) {echo "<tr><td>" . html_select("indexes[$ad][type]", array(-1 => "") + $Nc, $w["type"], ($ad == count($L["indexes"]) ? "indexesAddRow(this);" : 1)), "<td>";
            ksort($w["columns"]);
            $v = 1;foreach ($w["columns"] as $z => $d) {
                echo "<span>" . select_input(" name='indexes[$ad][columns][$v]' onchange=\"" . ($v == count($w["columns"]) ? "indexesAddColumn" : "indexesChangeColumn") . "(this, '" . js_escape($y == "sql" ? "" : $_GET["indexes"] . "_") . "');\"", ($o ? array_combine($o, $o) : $o), $d), ($y == "sql" || $y == "mssql" ? "<input type='number' name='indexes[$ad][lengths][$v]' class='size' value='" . h($w["lengths"][$z]) . "'>" : ""), ($y != "sql" ? checkbox("indexes[$ad][descs][$v]", 1, $w["descs"][$z], lang(46)) : ""), " </span>";
                $v++;}
            echo "<td><input name='indexes[$ad][name]' value='" . h($w["name"]) . "' autocapitalize='off'>\n", "<td><input type='image' class='icon' name='drop_col[$ad]' src='" . h(preg_replace("~\\?.*~", "", ME)) . "?file=cross.gif&amp;version=4.2.1&amp;driver=mysql' alt='x' title='" . lang(95) . "' onclick=\"return !editingRemoveRow(this, 'indexes\$1[type]');\">\n";}
        $ad++;}
    echo '</table>
<p>
<input type="submit" value="', lang(14), '">
<input type="hidden" name="token" value="', $T, '">
</form>
';} elseif (isset($_GET["database"])) {
    $L = $_POST;if ($_POST && !$m && !isset($_POST["add_x"])) {$F = trim($L["name"]);if ($_POST["drop"]) {$_GET["db"] = "";
        queries_redirect(remove_from_uri("db|database"), lang(165), drop_databases(array(DB)));} elseif (DB !== $F) {
        if (DB != "") {$_GET["db"] = $F;
            queries_redirect(preg_replace('~\bdb=[^&]*&~', '', ME) . "db=" . urlencode($F), lang(166), rename_database($F, $L["collation"]));} else {
            $j  = explode("\n", str_replace("\r", "", $F));
            $Mf = true;
            $id = "";foreach ($j as $k) {
                if (count($j) == 1 || $k != "") {if (!create_database($k, $L["collation"])) {
                    $Mf = false;
                }

                    $id = $k;}}
            restart_session();
            set_session("dbs", null);
            queries_redirect(ME . "db=" . urlencode($id), lang(167), $Mf);}} else {
        if (!$L["collation"]) {
            redirect(substr(ME, 0, -1));
        }

        query_redirect("ALTER DATABASE " . idf_escape($F) . (preg_match('~^[a-z0-9_]+$~i', $L["collation"]) ? " COLLATE $L[collation]" : ""), substr(ME, 0, -1), lang(168));}}
    page_header(DB != "" ? lang(55) : lang(169), $m, array(), h(DB));
    $Xa = collations();
    $F  = DB;if ($_POST) {
        $F = $L["name"];
    } elseif (DB != "") {
        $L["collation"] = db_collation(DB, $Xa);
    } elseif ($y == "sql") {
        foreach (get_vals("SHOW GRANTS") as $t) {if (preg_match('~ ON (`(([^\\\\`]|``|\\\\.)*)%`\\.\\*)?~', $t, $C) && $C[1]) {$F = stripcslashes(idf_unescape("`$C[2]`"));
            break;}}}
    echo '
<form action="" method="post">
<p>
', ($_POST["add_x"] || strpos($F, "\n") ? '<textarea id="name" name="name" rows="10" cols="40">' . h($F) . '</textarea><br>' : '<input name="name" id="name" value="' . h($F) . '" maxlength="64" autocapitalize="off">') . "\n" . ($Xa ? html_select("collation", array("" => "(" . lang(82) . ")") + $Xa, $L["collation"]) . doc_link(array('sql' => "charset-charsets.html", 'mssql' => "ms187963.aspx")) : ""); ?>
<script type='text/javascript'>focus(document.getElementById('name'));</script>
<input type="submit" value="<?php echo
    lang(14), '">
';if (DB != "") {
        echo "<input type='submit' name='drop' value='" . lang(111) . "'" . confirm() . ">\n";
    } elseif (!$_POST["add_x"] && $_GET["db"] == "") {
        echo "<input type='image' class='icon' name='add' src='" . h(preg_replace("~\\?.*~", "", ME)) . "?file=plus.gif&amp;version=4.2.1&amp;driver=mysql' alt='+' title='" . lang(92) . "'>\n";
    }

    echo '<input type="hidden" name="token" value="', $T, '">
</form>
';} elseif (isset($_GET["call"])) {
    $ca = $_GET["call"];
    page_header(lang(170) . ": " . h($ca), $m);
    $mf = routine($ca, (isset($_GET["callf"]) ? "FUNCTION" : "PROCEDURE"));
    $Mc = array();
    $pe = array();foreach ($mf["fields"] as $v => $n) {
        if (substr($n["inout"], -3) == "OUT") {
            $pe[$v] = "@" . idf_escape($n["field"]) . " AS " . idf_escape($n["field"]);
        }
        if (!$n["inout"] || substr($n["inout"], 0, 2) == "IN") {
            $Mc[] = $v;
        }
    }if (!$m && $_POST) {
        $Ja = array();foreach ($mf["fields"] as $z => $n) {if (in_array($z, $Mc)) {$X = process_input($n);if ($X === false) {
            $X = "''";
        }
            if (isset($pe[$z])) {
                $g->query("SET @" . idf_escape($n["field"]) . " = $X");
            }
        }
            $Ja[] = (isset($pe[$z]) ? "@" . idf_escape($n["field"]) : $X);}
        $I = (isset($_GET["callf"]) ? "SELECT" : "CALL") . " " . idf_escape($ca) . "(" . implode(", ", $Ja) . ")";
        echo "<p><code class='jush-$y'>" . h($I) . "</code> <a href='" . h(ME) . "sql=" . urlencode($I) . "'>" . lang(10) . "</a>\n";if (!$g->multi_query($I)) {
            echo "<p class='error'>" . error() . "\n";
        } else {
            $h = connect();if (is_object($h)) {
                $h->select_db(DB);
            }
            do {
                $J = $g->store_result();if (is_object($J)) {
                    select($J, $h);
                } else {
                    echo "<p class='message'>" . lang(171, $g->affected_rows) . "\n";
                }
            } while ($g->next_result());if ($pe) {
                select($g->query("SELECT " . implode(", ", $pe)));
            }
        }}
    echo '
<form action="" method="post">
';if ($Mc) {
        echo "<table cellspacing='0'>\n";foreach ($Mc as $z) {
            $n = $mf["fields"][$z];
            $F = $n["field"];
            echo "<tr><th>" . $c->fieldName($n);
            $Y = $_POST["fields"][$F];if ($Y != "") {
                if ($n["type"] == "enum") {
                    $Y = +$Y;
                }
                if ($n["type"] == "set") {
                    $Y = array_sum($Y);
                }
            }
            input($n, $Y, (string) $_POST["function"][$F]);
            echo "\n";}
        echo "</table>\n";}
    echo '<p>
<input type="submit" value="', lang(170), '">
<input type="hidden" name="token" value="', $T, '">
</form>
';} elseif (isset($_GET["foreign"])) {
    $b = $_GET["foreign"];
    $F = $_GET["name"];
    $L = $_POST;if ($_POST && !$m && !$_POST["add"] && !$_POST["change"] && !$_POST["change-js"]) {
        $D           = ($_POST["drop"] ? lang(172) : ($F != "" ? lang(173) : lang(174)));
        $B           = ME . "table=" . urlencode($b);
        $L["source"] = array_filter($L["source"], 'strlen');
        ksort($L["source"]);
        $Yf = array();foreach ($L["source"] as $z => $X) {
            $Yf[$z] = $L["target"][$z];
        }

        $L["target"] = $Yf;if ($y == "sqlite") {
            queries_redirect($B, $D, recreate_table($b, $b, array(), array(), array(" $F" => ($_POST["drop"] ? "" : " " . format_foreign_key($L)))));
        } else {
            $sa = "ALTER TABLE " . table($b);
            $Fb = "\nDROP " . ($y == "sql" ? "FOREIGN KEY " : "CONSTRAINT ") . idf_escape($F);if ($_POST["drop"]) {
                query_redirect($sa . $Fb, $B, $D);
            } else {
                query_redirect($sa . ($F != "" ? "$Fb," : "") . "\nADD" . format_foreign_key($L), $B, $D);
                $m = lang(175) . "<br>$m";}}}
    page_header(lang(176), $m, array("table" => $b), h($b));if ($_POST) {
        ksort($L["source"]);if ($_POST["add"]) {
            $L["source"][] = "";
        } elseif ($_POST["change"] || $_POST["change-js"]) {
            $L["target"] = array();
        }
    } elseif ($F != "") {
        $q             = foreign_keys($b);
        $L             = $q[$F];
        $L["source"][] = "";} else {
        $L["table"]  = $b;
        $L["source"] = array("");}
    $Cf = array_keys(fields($b));
    $Yf = ($b === $L["table"] ? $Cf : array_keys(fields($L["table"])));
    $af = array_keys(array_filter(table_status('', true), 'fk_support'));
    echo '
<form action="" method="post">
<p>
';if ($L["db"] == "" && $L["ns"] == "") {
        echo
        lang(177), ':
', html_select("table", $af, $L["table"], "this.form['change-js'].value = '1'; this.form.submit();"), '<input type="hidden" name="change-js" value="">
<noscript><p><input type="submit" name="change" value="', lang(178), '"></noscript>
<table cellspacing="0">
<thead><tr><th>', lang(117), '<th>', lang(118), '</thead>
';
        $ad = 0;foreach ($L["source"] as $z => $X) {
            echo "<tr>", "<td>" . html_select("source[" . (+$z) . "]", array(-1 => "") + $Cf, $X, ($ad == count($L["source"]) - 1 ? "foreignAddRow(this);" : 1)), "<td>" . html_select("target[" . (+$z) . "]", $Yf, $L["target"][$z]);
            $ad++;}
        echo '</table>
<p>
', lang(84), ': ', html_select("on_delete", array(-1 => "") + explode("|", $Zd), $L["on_delete"]), ' ', lang(83), ': ', html_select("on_update", array(-1 => "") + explode("|", $Zd), $L["on_update"]), doc_link(array('sql' => "innodb-foreign-key-constraints.html", 'pgsql' => "sql-createtable.html#SQL-CREATETABLE-REFERENCES", 'mssql' => "ms174979.aspx", 'oracle' => "clauses002.htm#sthref2903")), '<p>
<input type="submit" value="', lang(14), '">
<noscript><p><input type="submit" name="add" value="', lang(179), '"></noscript>
';}if ($F != "") {echo '<input type="submit" name="drop" value="', lang(111), '"', confirm(), '>';}
    echo '<input type="hidden" name="token" value="', $T, '">
</form>
';} elseif (isset($_GET["view"])) {
    $b = $_GET["view"];
    $L = $_POST;if ($_POST && !$m) {
        $F  = trim($L["name"]);
        $ua = " AS\n$L[select]";
        $B  = ME . "table=" . urlencode($F);
        $D  = lang(180);if ($_GET["materialized"]) {
            $U = "MATERIALIZED VIEW";
        } else {
            $U = "VIEW";if ($y == "pgsql") {$Gf = table_status($F);
                $U                             = ($Gf ? strtoupper($Gf["Engine"]) : $U);}}if (!$_POST["drop"] && $b == $F && $y != "sqlite" && $U != "MATERIALIZED VIEW") {
            query_redirect(($y == "mssql" ? "ALTER" : "CREATE OR REPLACE") . " VIEW " . table($F) . $ua, $B, $D);
        } else {
            $ag = $F . "_adminer_" . uniqid();
            drop_create("DROP $U " . table($b), "CREATE $U " . table($F) . $ua, "DROP $U " . table($F), "CREATE $U " . table($ag) . $ua, "DROP $U " . table($ag), ($_POST["drop"] ? substr(ME, 0, -1) : $B), lang(181), $D, lang(182), $b, $F);}}if (!$_POST && $b != "") {
        $L         = view($b);
        $L["name"] = $b;if (!$m) {
            $m = error();
        }
    }
    page_header(($b != "" ? lang(36) : lang(183)), $m, array("table" => $b), h($b));
    echo '
<form action="" method="post">
<p>', lang(164), ': <input name="name" value="', h($L["name"]), '" maxlength="64" autocapitalize="off">
<p>';
    textarea("select", $L["select"]);
    echo '<p>
<input type="submit" value="', lang(14), '">
';if ($_GET["view"] != "") {echo '<input type="submit" name="drop" value="', lang(111), '"', confirm(), '>';}
    echo '<input type="hidden" name="token" value="', $T, '">
</form>
';} elseif (isset($_GET["event"])) {
    $aa = $_GET["event"];
    $Sc = array("YEAR", "QUARTER", "MONTH", "DAY", "HOUR", "MINUTE", "WEEK", "SECOND", "YEAR_MONTH", "DAY_HOUR", "DAY_MINUTE", "DAY_SECOND", "HOUR_MINUTE", "HOUR_SECOND", "MINUTE_SECOND");
    $Hf = array("ENABLED" => "ENABLE", "DISABLED" => "DISABLE", "SLAVESIDE_DISABLED" => "DISABLE ON SLAVE");
    $L  = $_POST;if ($_POST && !$m) {
        if ($_POST["drop"]) {
            query_redirect("DROP EVENT " . idf_escape($aa), substr(ME, 0, -1), lang(184));
        } elseif (in_array($L["INTERVAL_FIELD"], $Sc) && isset($Hf[$L["STATUS"]])) {
            $qf = "\nON SCHEDULE " . ($L["INTERVAL_VALUE"] ? "EVERY " . q($L["INTERVAL_VALUE"]) . " $L[INTERVAL_FIELD]" . ($L["STARTS"] ? " STARTS " . q($L["STARTS"]) : "") . ($L["ENDS"] ? " ENDS " . q($L["ENDS"]) : "") : "AT " . q($L["STARTS"])) . " ON COMPLETION" . ($L["ON_COMPLETION"] ? "" : " NOT") . " PRESERVE";
            queries_redirect(substr(ME, 0, -1), ($aa != "" ? lang(185) : lang(186)), queries(($aa != "" ? "ALTER EVENT " . idf_escape($aa) . $qf . ($aa != $L["EVENT_NAME"] ? "\nRENAME TO " . idf_escape($L["EVENT_NAME"]) : "") : "CREATE EVENT " . idf_escape($L["EVENT_NAME"]) . $qf) . "\n" . $Hf[$L["STATUS"]] . " COMMENT " . q($L["EVENT_COMMENT"]) . rtrim(" DO\n$L[EVENT_DEFINITION]", ";") . ";"));}}
    page_header(($aa != "" ? lang(187) . ": " . h($aa) : lang(188)), $m);if (!$L && $aa != "") {
        $M = get_rows("SELECT * FROM information_schema.EVENTS WHERE EVENT_SCHEMA = " . q(DB) . " AND EVENT_NAME = " . q($aa));
        $L = reset($M);}
    echo '
<form action="" method="post">
<table cellspacing="0">
<tr><th>', lang(164), '<td><input name="EVENT_NAME" value="', h($L["EVENT_NAME"]), '" maxlength="64" autocapitalize="off">
<tr><th title="datetime">', lang(189), '<td><input name="STARTS" value="', h("$L[EXECUTE_AT]$L[STARTS]"), '">
<tr><th title="datetime">', lang(190), '<td><input name="ENDS" value="', h($L["ENDS"]), '">
<tr><th>', lang(191), '<td><input type="number" name="INTERVAL_VALUE" value="', h($L["INTERVAL_VALUE"]), '" class="size"> ', html_select("INTERVAL_FIELD", $Sc, $L["INTERVAL_FIELD"]), '<tr><th>', lang(102), '<td>', html_select("STATUS", $Hf, $L["STATUS"]), '<tr><th>', lang(91), '<td><input name="EVENT_COMMENT" value="', h($L["EVENT_COMMENT"]), '" maxlength="64">
<tr><th>&nbsp;<td>', checkbox("ON_COMPLETION", "PRESERVE", $L["ON_COMPLETION"] == "PRESERVE", lang(192)), '</table>
<p>';
    textarea("EVENT_DEFINITION", $L["EVENT_DEFINITION"]);
    echo '<p>
<input type="submit" value="', lang(14), '">
';if ($aa != "") {echo '<input type="submit" name="drop" value="', lang(111), '"', confirm(), '>';}
    echo '<input type="hidden" name="token" value="', $T, '">
</form>
';} elseif (isset($_GET["procedure"])) {
    $ca          = $_GET["procedure"];
    $mf          = (isset($_GET["function"]) ? "FUNCTION" : "PROCEDURE");
    $L           = $_POST;
    $L["fields"] = (array) $L["fields"];if ($_POST && !process_fields($L["fields"]) && !$m) {
        $ag = "$L[name]_adminer_" . uniqid();
        drop_create("DROP $mf " . idf_escape($ca), create_routine($mf, $L), "DROP $mf " . idf_escape($L["name"]), create_routine($mf, array("name" => $ag) + $L), "DROP $mf " . idf_escape($ag), substr(ME, 0, -1), lang(193), lang(194), lang(195), $ca, $L["name"]);}
    page_header(($ca != "" ? (isset($_GET["function"]) ? lang(196) : lang(197)) . ": " . h($ca) : (isset($_GET["function"]) ? lang(198) : lang(199))), $m);if (!$_POST && $ca != "") {
        $L         = routine($ca, $mf);
        $L["name"] = $ca;}
    $Xa = get_vals("SHOW CHARACTER SET");
    sort($Xa);
    $nf = routine_languages();
    echo '
<form action="" method="post" id="form">
<p>', lang(164), ': <input name="name" value="', h($L["name"]), '" maxlength="64" autocapitalize="off">
', ($nf ? lang(19) . ": " . html_select("language", $nf, $L["language"]) : ""), '<input type="submit" value="', lang(14), '">
<table cellspacing="0" class="nowrap">
';
    edit_fields($L["fields"], $Xa, $mf);if (isset($_GET["function"])) {
        echo "<tr><td>" . lang(200);
        edit_type("returns", $L["returns"], $Xa);}
    echo '</table>
<p>';
    textarea("definition", $L["definition"]);
    echo '<p>
<input type="submit" value="', lang(14), '">
';if ($ca != "") {echo '<input type="submit" name="drop" value="', lang(111), '"', confirm(), '>';}
    echo '<input type="hidden" name="token" value="', $T, '">
</form>
';} elseif (isset($_GET["trigger"])) {
    $b  = $_GET["trigger"];
    $F  = $_GET["name"];
    $sg = trigger_options();
    $L  = (array) trigger($F) + array("Trigger" => $b . "_bi");if ($_POST) {
        if (!$m && in_array($_POST["Timing"], $sg["Timing"]) && in_array($_POST["Event"], $sg["Event"]) && in_array($_POST["Type"], $sg["Type"])) {$Yd = " ON " . table($b);
            $Fb                            = "DROP TRIGGER " . idf_escape($F) . ($y == "pgsql" ? $Yd : "");
            $B                             = ME . "table=" . urlencode($b);if ($_POST["drop"]) {
                query_redirect($Fb, $B, lang(201));
            } else {
                if ($F != "") {
                    queries($Fb);
                }

                queries_redirect($B, ($F != "" ? lang(202) : lang(203)), queries(create_trigger($Yd, $_POST)));if ($F != "") {
                    queries(create_trigger($Yd, $L + array("Type" => reset($sg["Type"]))));
                }
            }}
        $L = $_POST;}
    page_header(($F != "" ? lang(204) . ": " . h($F) : lang(205)), $m, array("table" => $b));
    echo '
<form action="" method="post" id="form">
<table cellspacing="0">
<tr><th>', lang(206), '<td>', html_select("Timing", $sg["Timing"], $L["Timing"], "triggerChange(/^" . preg_quote($b, "/") . "_[ba][iud]$/, '" . js_escape($b) . "', this.form);"), '<tr><th>', lang(207), '<td>', html_select("Event", $sg["Event"], $L["Event"], "this.form['Timing'].onchange();"), (in_array("UPDATE OF", $sg["Event"]) ? " <input name='Of' value='" . h($L["Of"]) . "' class='hidden'>" : ""), '<tr><th>', lang(87), '<td>', html_select("Type", $sg["Type"], $L["Type"]), '</table>
<p>', lang(164), ': <input name="Trigger" value="', h($L["Trigger"]); ?>" maxlength="64" autocapitalize="off">
<script type="text/javascript">document.getElementById('form')['Timing'].onchange();</script>
<p><?php textarea("Statement", $L["Statement"]);
    echo '<p>
<input type="submit" value="', lang(14), '">
';if ($F != "") {echo '<input type="submit" name="drop" value="', lang(111), '"', confirm(), '>';}
    echo '<input type="hidden" name="token" value="', $T, '">
</form>
';} elseif (isset($_GET["user"])) {
    $ea = $_GET["user"];
    $Pe = array("" => array("All privileges" => ""));foreach (get_rows("SHOW PRIVILEGES") as $L) {
        foreach (explode(",", ($L["Privilege"] == "Grant option" ? "" : $L["Context"])) as $hb) {
            $Pe[$hb][$L["Privilege"]] = $L["Comment"];
        }
    }
    $Pe["Server Admin"] += $Pe["File access on server"];
    $Pe["Databases"]["Create routine"] = $Pe["Procedures"]["Create routine"];unset($Pe["Procedures"]["Create routine"]);
    $Pe["Columns"]                     = array();foreach (array("Select", "Insert", "Update", "References") as $X) {
        $Pe["Columns"][$X] = $Pe["Tables"][$X];
    }
    unset($Pe["Server Admin"]["Usage"]);foreach ($Pe["Tables"] as $z => $X) {
        unset($Pe["Databases"][$z]);
    }

    $Ld = array();if ($_POST) {
        foreach ($_POST["objects"] as $z => $X) {
            $Ld[$X] = (array) $Ld[$X] + (array) $_POST["grants"][$z];
        }
    }
    $yc = array();
    $Wd = "";if (isset($_GET["host"]) && ($J = $g->query("SHOW GRANTS FOR " . q($ea) . "@" . q($_GET["host"])))) {
        while ($L = $J->fetch_row()) {if (preg_match('~GRANT (.*) ON (.*) TO ~', $L[0], $C) && preg_match_all('~ *([^(,]*[^ ,(])( *\\([^)]+\\))?~', $C[1], $vd, PREG_SET_ORDER)) {foreach ($vd as $X) {
            if ($X[1] != "USAGE") {
                $yc["$C[2]$X[2]"][$X[1]] = true;
            }
            if (preg_match('~ WITH GRANT OPTION~', $L[0])) {
                $yc["$C[2]$X[2]"]["GRANT OPTION"] = true;
            }
        }}if (preg_match("~ IDENTIFIED BY PASSWORD '([^']+)~", $L[0], $C)) {
            $Wd = $C[1];
        }
        }}if ($_POST && !$m) {
        $Xd = (isset($_GET["host"]) ? q($ea) . "@" . q($_GET["host"]) : "''");if ($_POST["drop"]) {
            query_redirect("DROP USER $Xd", ME . "privileges=", lang(208));
        } else {
            $Nd = q($_POST["user"]) . "@" . q($_POST["host"]);
            $ze = $_POST["pass"];if ($ze != '' && !$_POST["hashed"]) {
                $ze = $g->result("SELECT PASSWORD(" . q($ze) . ")");
                $m  = !$ze;}
            $lb = false;if (!$m) {
                if ($Xd != $Nd) {$lb = queries(($g->server_info < 5 ? "GRANT USAGE ON *.* TO" : "CREATE USER") . " $Nd IDENTIFIED BY PASSWORD " . q($ze));
                    $m                             = !$lb;} elseif ($ze != $Wd) {
                    queries("SET PASSWORD FOR $Nd = " . q($ze));
                }
            }if (!$m) {
                $jf = array();foreach ($Ld as $Rd => $t) {
                    if (isset($_GET["grant"])) {
                        $t = array_filter($t);
                    }

                    $t = array_keys($t);if (isset($_GET["grant"])) {
                        $jf = array_diff(array_keys(array_filter($Ld[$Rd], 'strlen')), $t);
                    } elseif ($Xd == $Nd) {
                        $Ud = array_keys((array) $yc[$Rd]);
                        $jf = array_diff($Ud, $t);
                        $t  = array_diff($t, $Ud);unset($yc[$Rd]);}if (preg_match('~^(.+)\\s*(\\(.*\\))?$~U', $Rd, $C) && (!grant("REVOKE", $jf, $C[2], " ON $C[1] FROM $Nd") || !grant("GRANT", $t, $C[2], " ON $C[1] TO $Nd"))) {
                        $m = true;
                        break;}}}if (!$m && isset($_GET["host"])) {
                if ($Xd != $Nd) {
                    queries("DROP USER $Xd");
                } elseif (!isset($_GET["grant"])) {
                    foreach ($yc as $Rd => $jf) {
                        if (preg_match('~^(.+)(\\(.*\\))?$~U', $Rd, $C)) {
                            grant("REVOKE", array_keys($jf), $C[2], " ON $C[1] FROM $Nd");
                        }
                    }}}
            queries_redirect(ME . "privileges=", (isset($_GET["host"]) ? lang(209) : lang(210)), !$m);if ($lb) {
                $g->query("DROP USER $Nd");
            }
        }}
    page_header((isset($_GET["host"]) ? lang(29) . ": " . h("$ea@$_GET[host]") : lang(129)), $m, array("privileges" => array('', lang(59))));if ($_POST) {
        $L  = $_POST;
        $yc = $Ld;} else {
        $L         = $_GET + array("host" => $g->result("SELECT SUBSTRING_INDEX(CURRENT_USER, '@', -1)"));
        $L["pass"] = $Wd;if ($Wd != "") {
            $L["hashed"] = true;
        }

        $yc[(DB == "" || $yc ? "" : idf_escape(addcslashes(DB, "%_\\"))) . ".*"] = array();}
    echo '<form action="" method="post">
<table cellspacing="0">
<tr><th>', lang(28), '<td><input name="host" maxlength="60" value="', h($L["host"]), '" autocapitalize="off">
<tr><th>', lang(29), '<td><input name="user" maxlength="16" value="', h($L["user"]), '" autocapitalize="off">
<tr><th>', lang(30), '<td><input name="pass" id="pass" value="', h($L["pass"]), '">
';if (!$L["hashed"]) {echo '<script type="text/javascript">typePassword(document.getElementById(\'pass\'));</script>';}
    echo
    checkbox("hashed", 1, $L["hashed"], lang(211), "typePassword(this.form['pass'], this.checked);"), '</table>

';
    echo "<table cellspacing='0'>\n", "<thead><tr><th colspan='2'>" . lang(59) . doc_link(array('sql' => "grant.html#priv_level"));
    $v = 0;foreach ($yc as $Rd => $t) {
        echo '<th>' . ($Rd != "*.*" ? "<input name='objects[$v]' value='" . h($Rd) . "' size='10' autocapitalize='off'>" : "<input type='hidden' name='objects[$v]' value='*.*' size='10'>*.*");
        $v++;}
    echo "</thead>\n";foreach (array("" => "", "Server Admin" => lang(28), "Databases" => lang(31), "Tables" => lang(113), "Columns" => lang(114), "Procedures" => lang(212)) as $hb => $xb) {
        foreach ((array) $Pe[$hb] as $Oe => $bb) {echo "<tr" . odd() . "><td" . ($xb ? ">$xb<td" : " colspan='2'") . ' lang="en" title="' . h($bb) . '">' . h($Oe);
            $v = 0;foreach ($yc as $Rd => $t) {
                $F = "'grants[$v][" . h(strtoupper($Oe)) . "]'";
                $Y = $t[strtoupper($Oe)];if ($hb == "Server Admin" && $Rd != (isset($yc["*.*"]) ? "*.*" : ".*")) {
                    echo "<td>&nbsp;";
                } elseif (isset($_GET["grant"])) {
                    echo "<td><select name=$F><option><option value='1'" . ($Y ? " selected" : "") . ">" . lang(213) . "<option value='0'" . ($Y == "0" ? " selected" : "") . ">" . lang(214) . "</select>";
                } else {
                    echo "<td align='center'><label class='block'><input type='checkbox' name=$F value='1'" . ($Y ? " checked" : "") . ($Oe == "All privileges" ? " id='grants-$v-all'" : ($Oe == "Grant option" ? "" : " onclick=\"if (this.checked) formUncheck('grants-$v-all');\"")) . "></label>";
                }

                $v++;}}}
    echo "</table>\n", '<p>
<input type="submit" value="', lang(14), '">
';if (isset($_GET["host"])) {echo '<input type="submit" name="drop" value="', lang(111), '"', confirm(), '>';}
    echo '<input type="hidden" name="token" value="', $T, '">
</form>
';} elseif (isset($_GET["processlist"])) {
    if (support("kill") && $_POST && !$m) {$ed = 0;foreach ((array) $_POST["kill"] as $X) {if (queries("KILL " . number($X))) {
        $ed++;
    }
    }
        queries_redirect(ME . "processlist=", lang(215, $ed), $ed || !$_POST["kill"]);}
    page_header(lang(100), $m);
    echo '
<form action="" method="post">
<table cellspacing="0" onclick="tableClick(event);" ondblclick="tableClick(event, true);" class="nowrap checkable">
';
    $v = -1;foreach (process_list() as $v => $L) {
        if (!$v) {echo "<thead><tr lang='en'>" . (support("kill") ? "<th>&nbsp;" : "");foreach ($L as $z => $X) {
            echo "<th>$z" . doc_link(array('sql' => "show-processlist.html#processlist_" . strtolower($z), 'pgsql' => "monitoring-stats.html#PG-STAT-ACTIVITY-VIEW", 'oracle' => "../b14237/dynviews_2088.htm"));
        }

            echo "</thead>\n";}
        echo "<tr" . odd() . ">" . (support("kill") ? "<td>" . checkbox("kill[]", $L["Id"], 0) : "");foreach ($L as $z => $X) {
            echo "<td>" . (($y == "sql" && $z == "Info" && preg_match("~Query|Killed~", $L["Command"]) && $X != "") || ($y == "pgsql" && $z == "current_query" && $X != "<IDLE>") || ($y == "oracle" && $z == "sql_text" && $X != "") ? "<code class='jush-$y'>" . shorten_utf8($X, 100, "</code>") . ' <a href="' . h(ME . ($L["db"] != "" ? "db=" . urlencode($L["db"]) . "&" : "") . "sql=" . urlencode($X)) . '">' . lang(216) . '</a>' : nbsp($X));
        }

        echo "\n";}
    echo '</table>
<script type=\'text/javascript\'>tableCheck();</script>
<p>
';if (support("kill")) {echo ($v + 1) . "/" . lang(217, $g->result("SELECT @@max_connections")), "<p><input type='submit' value='" . lang(218) . "'>\n";}
    echo '<input type="hidden" name="token" value="', $T, '">
</form>
';} elseif (isset($_GET["select"])) {
    $b  = $_GET["select"];
    $R  = table_status1($b);
    $x  = indexes($b);
    $o  = fields($b);
    $q  = column_foreign_keys($b);
    $Td = "";if ($R["Oid"]) {
        $Td  = ($y == "sqlite" ? "rowid" : "oid");
        $x[] = array("type" => "PRIMARY", "columns" => array($Td));}
    parse_str($_COOKIE["adminer_import"], $ma);
    $kf = array();
    $e  = array();
    $dg = null;foreach ($o as $z => $n) {
        $F = $c->fieldName($n);if (isset($n["privileges"]["select"]) && $F != "") {$e[$z] = html_entity_decode(strip_tags($F), ENT_QUOTES);if (is_shortable($n)) {
            $dg = $c->selectLengthProcess();
        }
        }
        $kf += $n["privileges"];}
    list($N, $u) = $c->selectColumnsProcess($e, $x);
    $Wc          = count($u) < count($N);
    $Z           = $c->selectSearchProcess($o, $x);
    $he          = $c->selectOrderProcess($o, $x);
    $_           = $c->selectLimitProcess();
    $wc          = ($N ? implode(", ", $N) : "*" . ($Td ? ", $Td" : "")) . convert_fields($e, $o, $N) . "\nFROM " . table($b);
    $zc          = ($u && $Wc ? "\nGROUP BY " . implode(", ", $u) : "") . ($he ? "\nORDER BY " . implode(", ", $he) : "");if ($_GET["val"] && is_ajax()) {
        header("Content-Type: text/plain; charset=utf-8");foreach ($_GET["val"] as $_g => $L) {$ua = convert_field($o[key($L)]);
            $N                             = array($ua ? $ua : idf_escape(key($L)));
            $Z[]                           = where_check($_g, $o);
            $K                             = $l->select($b, $N, $Z, $N);if ($K) {
                echo
                reset($K->fetch_row());
            }
        }
        exit;}if ($_POST && !$m) {
        $Sg = $Z;if (!$_POST["all"] && is_array($_POST["check"])) {$Oa = array();foreach ($_POST["check"] as $Ma) {
            $Oa[] = where_check($Ma, $o);
        }

            $Sg[] = "((" . implode(") OR (", $Oa) . "))";}
        $Sg = ($Sg ? "\nWHERE " . implode(" AND ", $Sg) : "");
        $Le = $Bg = null;foreach ($x as $w) {
            if ($w["type"] == "PRIMARY") {$Le = array_flip($w["columns"]);
                $Bg                            = ($N ? $Le : array());
                break;}}
        foreach ((array) $Bg as $z => $X) {
            if (in_array(idf_escape($z), $N)) {
                unset($Bg[$z]);
            }
        }if ($_POST["export"]) {
            cookie("adminer_import", "output=" . urlencode($_POST["output"]) . "&format=" . urlencode($_POST["format"]));
            dump_headers($b);
            $c->dumpTable($b, "");if (!is_array($_POST["check"]) || $Bg === array()) {
                $I = "SELECT $wc$Sg$zc";
            } else {
                $yg = array();foreach ($_POST["check"] as $X) {
                    $yg[] = "(SELECT" . limit($wc, "\nWHERE " . ($Z ? implode(" AND ", $Z) . " AND " : "") . where_check($X, $o) . $zc, 1) . ")";
                }

                $I = implode(" UNION ALL ", $yg);}
            $c->dumpData($b, "table", $I);exit;}if (!$c->selectEmailProcess($Z, $q)) {
            if ($_POST["save"] || $_POST["delete"]) {$J = true;
                $na                           = 0;
                $P                            = array();if (!$_POST["delete"]) {
                    foreach ($e as $F => $X) {
                        $X = process_input($o[$F]);if ($X !== null && ($_POST["clone"] || $X !== false)) {
                            $P[idf_escape($F)] = ($X !== false ? $X : idf_escape($F));
                        }
                    }}if ($_POST["delete"] || $P) {
                    if ($_POST["clone"]) {
                        $I = "INTO " . table($b) . " (" . implode(", ", array_keys($P)) . ")\nSELECT " . implode(", ", $P) . "\nFROM " . table($b);
                    }
                    if ($_POST["all"] || ($Bg === array() && is_array($_POST["check"])) || $Wc) {
                        $J  = ($_POST["delete"] ? $l->delete($b, $Sg) : ($_POST["clone"] ? queries("INSERT $I$Sg") : $l->update($b, $P, $Sg)));
                        $na = $g->affected_rows;} else {
                        foreach ((array) $_POST["check"] as $X) {$Rg = "\nWHERE " . ($Z ? implode(" AND ", $Z) . " AND " : "") . where_check($X, $o);
                            $J                             = ($_POST["delete"] ? $l->delete($b, $Rg, 1) : ($_POST["clone"] ? queries("INSERT" . limit1($I, $Rg)) : $l->update($b, $P, $Rg)));if (!$J) {
                                break;
                            }

                            $na += $g->affected_rows;}}}
                $D = lang(219, $na);if ($_POST["clone"] && $J && $na == 1) {
                    $jd = last_id();if ($jd) {
                        $D = lang(150, " $jd");
                    }
                }
                queries_redirect(remove_from_uri($_POST["all"] && $_POST["delete"] ? "page" : ""), $D, $J);if (!$_POST["delete"]) {
                    edit_form($b, $o, (array) $_POST["fields"], !$_POST["clone"]);
                    page_footer();exit;}} elseif (!$_POST["import"]) {
                if (!$_POST["val"]) {
                    $m = lang(220);
                } else {
                    $J  = true;
                    $na = 0;foreach ($_POST["val"] as $_g => $L) {
                        $P = array();foreach ($L as $z => $X) {
                            $z                 = bracket_escape($z, 1);
                            $P[idf_escape($z)] = (preg_match('~char|text~', $o[$z]["type"]) || $X != "" ? $c->processInput($o[$z], $X) : "NULL");}
                        $J = $l->update($b, $P, " WHERE " . ($Z ? implode(" AND ", $Z) . " AND " : "") . where_check($_g, $o), !($Wc || $Bg === array()), " ");if (!$J) {
                            break;
                        }

                        $na += $g->affected_rows;}
                    queries_redirect(remove_from_uri(), lang(219, $na), $J);}} elseif (!is_string($mc = get_file("csv_file", true))) {
                $m = upload_error($mc);
            } elseif (!preg_match('~~u', $mc)) {
                $m = lang(221);
            } else {
                cookie("adminer_import", "output=" . urlencode($ma["output"]) . "&format=" . urlencode($_POST["separator"]));
                $J  = true;
                $Ya = array_keys($o);
                preg_match_all('~(?>"[^"]*"|[^"\\r\\n]+)+~', $mc, $vd);
                $na = count($vd[0]);
                $l->begin();
                $wf = ($_POST["separator"] == "csv" ? "," : ($_POST["separator"] == "tsv" ? "\t" : ";"));
                $M  = array();foreach ($vd[0] as $z => $X) {
                    preg_match_all("~((?>\"[^\"]*\")+|[^$wf]*)$wf~", $X . $wf, $wd);if (!$z && !array_diff($wd[1], $Ya)) {$Ya = $wd[1];
                        $na--;} else {
                        $P = array();foreach ($wd[1] as $v => $Ua) {
                            $P[idf_escape($Ya[$v])] = ($Ua == "" && $o[$Ya[$v]]["null"] ? "NULL" : q(str_replace('""', '"', preg_replace('~^"|"$~', '', $Ua))));
                        }

                        $M[] = $P;}}
                $J = (!$M || $l->insertUpdate($b, $M, $Le));if ($J) {
                    $l->commit();
                }

                queries_redirect(remove_from_uri("page"), lang(222, $na), $J);
                $l->rollback();}}}
    $Sf = $c->tableName($R);if (is_ajax()) {
        page_headers();
        ob_start();} else {
        page_header(lang(40) . ": $Sf", $m);
    }

    $P = null;if (isset($kf["insert"]) || !support("table")) {
        $P = "";foreach ((array) $_GET["where"] as $X) {if (count($q[$X["col"]]) == 1 && ($X["op"] == "=" || (!$X["op"] && !preg_match('~[_%]~', $X["val"])))) {
            $P .= "&set" . urlencode("[" . bracket_escape($X["col"]) . "]") . "=" . urlencode($X["val"]);
        }
        }}
    $c->selectLinks($R, $P);if (!$e && support("table")) {
        echo "<p class='error'>" . lang(223) . ($o ? "." : ": " . error()) . "\n";
    } else {
        echo "<form action='' id='form'>\n", "<div style='display: none;'>";
        hidden_fields_get();
        echo (DB != "" ? '<input type="hidden" name="db" value="' . h(DB) . '">' . (isset($_GET["ns"]) ? '<input type="hidden" name="ns" value="' . h($_GET["ns"]) . '">' : "") : "");
        echo '<input type="hidden" name="select" value="' . h($b) . '">', "</div>\n";
        $c->selectColumnsPrint($N, $e);
        $c->selectSearchPrint($Z, $e, $x);
        $c->selectOrderPrint($he, $e, $x);
        $c->selectLimitPrint($_);
        $c->selectLengthPrint($dg);
        $c->selectActionPrint($x);
        echo "</form>\n";
        $G = $_GET["page"];if ($G == "last") {
            $vc = $g->result(count_rows($b, $Z, $Wc, $u));
            $G  = floor(max(0, $vc - 1) / $_);}
        $tf = $N;if (!$tf) {
            $tf[] = "*";if ($Td) {
                $tf[] = $Td;
            }
        }
        $ib = convert_fields($e, $o, $N);if ($ib) {
            $tf[] = substr($ib, 2);
        }

        $J = $l->select($b, $tf, $Z, $u, $he, $_, $G, true);if (!$J) {
            echo "<p class='error'>" . error() . "\n";
        } else {
            if ($y == "mssql" && $G) {
                $J->seek($_ * $G);
            }

            $Rb = array();
            echo "<form action='' method='post' enctype='multipart/form-data'>\n";
            $M = array();while ($L = $J->fetch_assoc()) {
                if ($G && $y == "oracle") {
                    unset($L["RNUM"]);
                }

                $M[] = $L;}if ($_GET["page"] != "last" && +$_ && $u && $Wc && $y == "sql") {
                $vc = $g->result(" SELECT FOUND_ROWS()");
            }
            if (!$M) {
                echo "<p class='message'>" . lang(12) . "\n";
            } else {
                $Ba = $c->backwardKeys($b, $Sf);
                echo "<table id='table' cellspacing='0' class='nowrap checkable' onclick='tableClick(event);' ondblclick='tableClick(event, true);' onkeydown='return editingKeydown(event);'>\n", "<thead><tr>" . (!$u && $N ? "" : "<td><input type='checkbox' id='all-page' onclick='formCheck(this, /check/);'> <a href='" . h($_GET["modify"] ? remove_from_uri("modify") : $_SERVER["REQUEST_URI"] . "&modify=1") . "'>" . lang(224) . "</a>");
                $Kd = array();
                $xc = array();
                reset($N);
                $Xe = 1;foreach ($M[0] as $z => $X) {
                    if ($z != $Td) {$X = $_GET["columns"][key($N)];
                        $n                            = $o[$N ? ($X ? $X["col"] : current($N)) : $z];
                        $F                            = ($n ? $c->fieldName($n, $Xe) : ($X["fun"] ? "*" : $z));if ($F != "") {
                            $Xe++;
                            $Kd[$z] = $F;
                            $d      = idf_escape($z);
                            $Hc     = remove_from_uri('(order|desc)[^=]*|page') . '&order%5B0%5D=' . urlencode($z);
                            $xb     = "&desc%5B0%5D=1";
                            echo '<th onmouseover="columnMouse(this);" onmouseout="columnMouse(this, \' hidden\');">', '<a href="' . h($Hc . ($he[0] == $d || $he[0] == $z || (!$he && $Wc && $u[0] == $d) ? $xb : '')) . '">';
                            echo
                            apply_sql_function($X["fun"], $F) . "</a>";
                            echo "<span class='column hidden'>", "<a href='" . h($Hc . $xb) . "' title='" . lang(46) . "' class='text'> â†“</a>";if (!$X["fun"]) {
                                echo '<a href="#fieldset-search" onclick="selectSearch(\'' . h(js_escape($z)) . '\'); return false;" title="' . lang(43) . '" class="text jsonly"> =</a>';
                            }

                            echo "</span>";}
                        $xc[$z] = $X["fun"];
                        next($N);}}
                $pd = array();if ($_GET["modify"]) {
                    foreach ($M as $L) {
                        foreach ($L as $z => $X) {
                            $pd[$z] = max($pd[$z], min(40, strlen(utf8_decode($X))));
                        }
                    }}
                echo ($Ba ? "<th>" . lang(225) : "") . "</thead>\n";if (is_ajax()) {
                    if ($_ % 2 == 1 && $G % 2 == 1) {
                        odd();
                    }

                    ob_end_clean();}
                foreach ($c->rowDescriptions($M, $q) as $E => $L) {
                    $zg = unique_array($M[$E], $x);if (!$zg) {$zg = array();foreach ($M[$E] as $z => $X) {if (!preg_match('~^(COUNT\\((\\*|(DISTINCT )?`(?:[^`]|``)+`)\\)|(AVG|GROUP_CONCAT|MAX|MIN|SUM)\\(`(?:[^`]|``)+`\\))$~', $z)) {
                        $zg[$z] = $X;
                    }
                    }}
                    $_g = "";foreach ($zg as $z => $X) {
                        if (($y == "sql" || $y == "pgsql") && strlen($X) > 64) {$z = (strpos($z, '(') ? $z : idf_escape($z));
                            $z                            = "MD5(" . ($y == 'sql' && preg_match("~^utf8_~", $o[$z]["collation"]) ? $z : "CONVERT($z USING " . charset($g) . ")") . ")";
                            $X                            = md5($X);}
                        $_g .= "&" . ($X !== null ? urlencode("where[" . bracket_escape($z) . "]") . "=" . urlencode($X) : "null%5B%5D=" . urlencode($z));}
                    echo "<tr" . odd() . ">" . (!$u && $N ? "" : "<td>" . checkbox("check[]", substr($_g, 1), in_array(substr($_g, 1), (array) $_POST["check"]), "", "this.form['all'].checked = false; formUncheck('all-page');") . ($Wc || information_schema(DB) ? "" : " <a href='" . h(ME . "edit=" . urlencode($b) . $_g) . "'>" . lang(226) . "</a>"));foreach ($L as $z => $X) {
                        if (isset($Kd[$z])) {$n = $o[$z];if ($X != "" && (!isset($Rb[$z]) || $Rb[$z] != "")) {
                            $Rb[$z] = (is_mail($X) ? $Kd[$z] : "");
                        }

                            $A = "";if (preg_match('~blob|bytea|raw|file~', $n["type"]) && $X != "") {
                                $A = ME . 'download=' . urlencode($b) . '&field=' . urlencode($z) . $_g;
                            }
                            if (!$A && $X !== null) {
                                foreach ((array) $q[$z] as $p) {if (count($q[$z]) == 1 || end($p["source"]) == $z) {$A = "";foreach ($p["source"] as $v => $Cf) {
                                    $A .= where_link($v, $p["target"][$v], $M[$E][$Cf]);
                                }

                                    $A = ($p["db"] != "" ? preg_replace('~([?&]db=)[^&]+~', '\\1' . urlencode($p["db"]), ME) : ME) . 'select=' . urlencode($p["table"]) . $A;if (count($p["source"]) == 1) {
                                        break;
                                    }
                                }}}if ($z == "COUNT(*)") {
                                $A = ME . "select=" . urlencode($b);
                                $v = 0;foreach ((array) $_GET["where"] as $W) {
                                    if (!array_key_exists($W["col"], $zg)) {
                                        $A .= where_link($v++, $W["col"], $W["val"], $W["op"]);
                                    }
                                }
                                foreach ($zg as $bd => $W) {
                                    $A .= where_link($v++, $bd, $W);
                                }
                            }
                            $X  = select_value($X, $A, $n, $dg);
                            $Ic = h("val[$_g][" . bracket_escape($z) . "]");
                            $Y  = $_POST["val"][$_g][bracket_escape($z)];
                            $Mb = !is_array($L[$z]) && is_utf8($X) && $M[$E][$z] == $L[$z] && !$xc[$z];
                            $cg = preg_match('~text|lob~', $n["type"]);if (($_GET["modify"] && $Mb) || $Y !== null) {
                                $Ac = h($Y !== null ? $Y : $L[$z]);
                                echo "<td>" . ($cg ? "<textarea name='$Ic' cols='30' rows='" . (substr_count($L[$z], "\n") + 1) . "'>$Ac</textarea>" : "<input name='$Ic' value='$Ac' size='$pd[$z]'>");} else {
                                $ud = strpos($X, "<i>...</i>");
                                echo "<td id='$Ic' onclick=\"selectClick(this, event, " . ($ud ? 2 : ($cg ? 1 : 0)) . ($Mb ? "" : ", '" . h(lang(227)) . "'") . ");\">$X";}}}if ($Ba) {
                        echo "<td>";
                    }

                    $c->backwardKeysPrint($Ba, $M[$E]);
                    echo "</tr>\n";}if (is_ajax()) {
                    exit;
                }

                echo "</table>\n";}if (($M || $G) && !is_ajax()) {
                $bc = true;if ($_GET["page"] != "last") {if (!+$_) {
                    $vc = count($M);
                } elseif ($y != "sql" || !$Wc) {
                    $vc = ($Wc ? false : found_rows($R, $Z));if ($vc < max(1e4, 2 * ($G + 1) * $_)) {
                        $vc = reset(slow_query(count_rows($b, $Z, $Wc, $u)));
                    } else {
                        $bc = false;
                    }
                }}if (+$_ && ($vc === false || $vc > $_ || $G)) {
                    echo "<p class='pages'>";
                    $yd = ($vc === false ? $G + (count($M) >= $_ ? 2 : 1) : floor(($vc - 1) / $_));if ($y != "simpledb") {
                        echo '<a href="' . h(remove_from_uri("page")) . "\" onclick=\"pageClick(this.href, +prompt('" . lang(228) . "', '" . ($G + 1) . "'), event); return false;\">" . lang(228) . "</a>:", pagination(0, $G) . ($G > 5 ? " ..." : "");for ($v = max(1, $G - 4); $v < min($yd, $G + 5); $v++) {
                            echo
                            pagination($v, $G);
                        }
                        if ($yd > 0) {echo ($G + 5 < $yd ? " ..." : ""), ($bc && $vc !== false ? pagination($yd, $G) : " <a href='" . h(remove_from_uri("page") . "&page=last") . "' title='~$yd'>" . lang(229) . "</a>");}
                        echo (($vc === false ? count($M) + 1 : $vc - $G * $_) > $_ ? ' <a href="' . h(remove_from_uri("page") . "&page=" . ($G + 1)) . '" onclick="return !selectLoadMore(this, ' . (+$_) . ', \'' . lang(230) . '...\');" class="loadmore">' . lang(231) . '</a>' : '');} else {
                        echo
                        lang(228) . ":", pagination(0, $G) . ($G > 1 ? " ..." : ""), ($G ? pagination($G, $G) : ""), ($yd > $G ? pagination($G + 1, $G) . ($yd > $G + 1 ? " ..." : "") : "");}}
                echo "<p class='count'>\n", ($vc !== false ? "(" . ($bc ? "" : "~ ") . lang(132, $vc) . ") " : "");
                $Bb = ($bc ? "" : "~ ") . $vc;
                echo
                checkbox("all", 1, 0, lang(232), "var checked = formChecked(this, /check/); selectCount('selected', this.checked ? '$Bb' : checked); selectCount('selected2', this.checked || !checked ? '$Bb' : checked);") . "\n";if ($c->selectCommandPrint()) {echo '<fieldset', ($_GET["modify"] ? '' : ' class="jsonly"'), '><legend>', lang(224), '</legend><div>
<input type="submit" value="', lang(14), '"', ($_GET["modify"] ? '' : ' title="' . lang(220) . '"'), '>
</div></fieldset>
<fieldset><legend>', lang(110), ' <span id="selected"></span></legend><div>
<input type="submit" name="edit" value="', lang(10), '">
<input type="submit" name="clone" value="', lang(216), '">
<input type="submit" name="delete" value="', lang(18), '"', confirm(), '>
</div></fieldset>
';}
                $tc = $c->dumpFormat();foreach ((array) $_GET["columns"] as $d) {
                    if ($d["fun"]) {unset($tc['sql']);
                        break;}}if ($tc) {
                    print_fieldset("export", lang(61) . " <span id='selected2'></span>");
                    $qe = $c->dumpOutput();
                    echo ($qe ? html_select("output", $qe, $ma["output"]) . " " : ""), html_select("format", $tc, $ma["format"]), " <input type='submit' name='export' value='" . lang(61) . "'>\n", "</div></fieldset>\n";}
                echo (!$u && $N ? "" : "<script type='text/javascript'>tableCheck();</script>\n");}if ($c->selectImportPrint()) {
                print_fieldset("import", lang(60), !$M);
                echo "<input type='file' name='csv_file'> ", html_select("separator", array("csv" => "CSV,", "csv;" => "CSV;", "tsv" => "TSV"), $ma["format"], 1);
                echo " <input type='submit' name='import' value='" . lang(60) . "'>", "</div></fieldset>\n";}
            $c->selectEmailPrint(array_filter($Rb, 'strlen'), $e);
            echo "<p><input type='hidden' name='token' value='$T'></p>\n", "</form>\n";}}if (is_ajax()) {ob_end_clean();exit;}} elseif (isset($_GET["variables"])) {
    $Gf = isset($_GET["status"]);
    page_header($Gf ? lang(102) : lang(101));
    $Lg = ($Gf ? show_status() : show_variables());if (!$Lg) {
        echo "<p class='message'>" . lang(12) . "\n";
    } else {
        echo "<table cellspacing='0'>\n";foreach ($Lg as $z => $X) {echo "<tr>", "<th><code class='jush-" . $y . ($Gf ? "status" : "set") . "'>" . h($z) . "</code>", "<td>" . nbsp($X);}
        echo "</table>\n";}} elseif (isset($_GET["script"])) {
    header("Content-Type: text/javascript; charset=utf-8");if ($_GET["script"] == "db") {$Pf = array("Data_length" => 0, "Index_length" => 0, "Data_free" => 0);foreach (table_status() as $F => $R) {json_row("Comment-$F", nbsp($R["Comment"]));if (!is_view($R)) {foreach (array("Engine", "Collation") as $z) {
        json_row("$z-$F", nbsp($R[$z]));
    }
        foreach ($Pf + array("Auto_increment" => 0, "Rows" => 0) as $z => $X) {
            if ($R[$z] != "") {$X = format_number($R[$z]);
                json_row("$z-$F", ($z == "Rows" && $X && $R["Engine"] == ($Ef == "pgsql" ? "table" : "InnoDB") ? "~ $X" : $X));if (isset($Pf[$z])) {
                    $Pf[$z] += ($R["Engine"] != "InnoDB" || $z != "Data_free" ? $R[$z] : 0);
                }
            } elseif (array_key_exists($z, $R)) {
                json_row("$z-$F");
            }
        }}}
        foreach ($Pf as $z => $X) {
            json_row("sum-$z", format_number($X));
        }

        json_row("");} elseif ($_GET["script"] == "kill") {
        $g->query("KILL " . number($_POST["kill"]));
    } else {
        foreach (count_tables($c->databases()) as $k => $X) {json_row("tables-$k", $X);
            json_row("size-$k", db_size($k));}
        json_row("");}
    exit;} else {
    $Xf = array_merge((array) $_POST["tables"], (array) $_POST["views"]);if ($Xf && !$m && !$_POST["search"]) {$J = true;
        $D                            = "";if ($y == "sql" && count($_POST["tables"]) > 1 && ($_POST["drop"] || $_POST["truncate"] || $_POST["copy"])) {
            queries("SET foreign_key_checks = 0");
        }
        if ($_POST["truncate"]) {
            if ($_POST["tables"]) {
                $J = truncate_tables($_POST["tables"]);
            }

            $D = lang(233);} elseif ($_POST["move"]) {
            $J = move_tables((array) $_POST["tables"], (array) $_POST["views"], $_POST["target"]);
            $D = lang(234);} elseif ($_POST["copy"]) {
            $J = copy_tables((array) $_POST["tables"], (array) $_POST["views"], $_POST["target"]);
            $D = lang(235);} elseif ($_POST["drop"]) {
            if ($_POST["views"]) {
                $J = drop_views($_POST["views"]);
            }
            if ($J && $_POST["tables"]) {
                $J = drop_tables($_POST["tables"]);
            }

            $D = lang(236);} elseif ($y != "sql") {
            $J = ($y == "sqlite" ? queries("VACUUM") : apply_queries("VACUUM" . ($_POST["optimize"] ? "" : " ANALYZE"), $_POST["tables"]));
            $D = lang(237);} elseif (!$_POST["tables"]) {
            $D = lang(9);
        } elseif ($J = queries(($_POST["optimize"] ? "OPTIMIZE" : ($_POST["check"] ? "CHECK" : ($_POST["repair"] ? "REPAIR" : "ANALYZE"))) . " TABLE " . implode(", ", array_map('idf_escape', $_POST["tables"])))) {
            while ($L = $J->fetch_assoc()) {
                $D .= "<b>" . h($L["Table"]) . "</b>: " . h($L["Msg_text"]) . "<br>";
            }
        }
        queries_redirect(substr(ME, 0, -1), $D, $J);}
    page_header(($_GET["ns"] == "" ? lang(31) . ": " . h(DB) : lang(238) . ": " . h($_GET["ns"])), $m, true);if ($c->homepage()) {
        if ($_GET["ns"] !== "") {echo "<h3 id='tables-views'>" . lang(239) . "</h3>\n";
            $Wf = tables_list();if (!$Wf) {
                echo "<p class='message'>" . lang(9) . "\n";
            } else {
                echo "<form action='' method='post'>\n";if (support("table")) {echo "<fieldset><legend>" . lang(240) . " <span id='selected2'></span></legend><div>", "<input type='search' name='query' value='" . h($_POST["query"]) . "'> <input type='submit' name='search' value='" . lang(43) . "'>\n", "</div></fieldset>\n";if ($_POST["search"] && $_POST["query"] != "") {
                    search_tables();
                }
                }
                echo "<table cellspacing='0' class='nowrap checkable' onclick='tableClick(event);' ondblclick='tableClick(event, true);'>\n", '<thead><tr class="wrap"><td><input id="check-all" type="checkbox" onclick="formCheck(this, /^(tables|views)\[/);">';
                $Cb = doc_link(array('sql' => 'show-table-status.html'));
                echo '<th>' . lang(113), '<td>' . lang(241) . doc_link(array('sql' => 'storage-engines.html')), '<td>' . lang(106) . doc_link(array('sql' => 'charset-mysql.html')), '<td>' . lang(242) . $Cb, '<td>' . lang(243) . $Cb, '<td>' . lang(244) . $Cb, '<td>' . lang(52) . doc_link(array('sql' => 'example-auto-increment.html')), '<td>' . lang(245) . $Cb, (support("comment") ? '<td>' . lang(91) . $Cb : ''), "</thead>\n";
                $S = 0;foreach ($Wf as $F => $U) {
                    $Ng = ($U !== null && !preg_match('~table~i', $U));
                    echo '<tr' . odd() . '><td>' . checkbox(($Ng ? "views[]" : "tables[]"), $F, in_array($F, $Xf, true), "", "formUncheck('check-all');"), '<th>' . (support("table") || support("indexes") ? '<a href="' . h(ME) . 'table=' . urlencode($F) . '" title="' . lang(35) . '">' . h($F) . '</a>' : h($F));if ($Ng) {echo '<td colspan="6"><a href="' . h(ME) . "view=" . urlencode($F) . '" title="' . lang(36) . '">' . (preg_match('~materialized~i', $U) ? lang(246) : lang(112)) . '</a>', '<td align="right"><a href="' . h(ME) . "select=" . urlencode($F) . '" title="' . lang(34) . '">?</a>';} else {
                        foreach (array("Engine" => array(), "Collation" => array(), "Data_length" => array("create", lang(37)), "Index_length" => array("indexes", lang(116)), "Data_free" => array("edit", lang(38)), "Auto_increment" => array("auto_increment=1&create", lang(37)), "Rows" => array("select", lang(34))) as $z => $A) {$Ic = " id='$z-" . h($F) . "'";
                            echo ($A ? "<td align='right'>" . (support("table") || $z == "Rows" || (support("indexes") && $z != "Data_length") ? "<a href='" . h(ME . "$A[0]=") . urlencode($F) . "'$Ic title='$A[1]'>?</a>" : "<span$Ic>?</span>") : "<td id='$z-" . h($F) . "'>&nbsp;");}
                        $S++;}
                    echo (support("comment") ? "<td id='Comment-" . h($F) . "'>&nbsp;" : "");}
                echo "<tr><td>&nbsp;<th>" . lang(217, count($Wf)), "<td>" . nbsp($y == "sql" ? $g->result("SELECT @@storage_engine") : ""), "<td>" . nbsp(db_collation(DB, collations()));foreach (array("Data_length", "Index_length", "Data_free") as $z) {
                    echo "<td align='right' id='sum-$z'>&nbsp;";
                }

                echo "</table>\n";if (!information_schema(DB)) {
                    $Jg = "<input type='submit' value='" . lang(247) . "'" . on_help("'VACUUM'") . "> ";
                    $ee = "<input type='submit' name='optimize' value='" . lang(248) . "'" . on_help($y == "sql" ? "'OPTIMIZE TABLE'" : "'VACUUM OPTIMIZE'") . "> ";
                    echo "<fieldset><legend>" . lang(110) . " <span id='selected'></span></legend><div>" . ($y == "sqlite" ? $Jg : ($y == "pgsql" ? $Jg . $ee : ($y == "sql" ? "<input type='submit' value='" . lang(249) . "'" . on_help("'ANALYZE TABLE'") . "> " . $ee . "<input type='submit' name='check' value='" . lang(250) . "'" . on_help("'CHECK TABLE'") . "> " . "<input type='submit' name='repair' value='" . lang(251) . "'" . on_help("'REPAIR TABLE'") . "> " : ""))) . "<input type='submit' name='truncate' value='" . lang(252) . "'" . confirm() . on_help($y == "sqlite" ? "'DELETE'" : "'TRUNCATE" . ($y == "pgsql" ? "'" : " TABLE'")) . "> " . "<input type='submit' name='drop' value='" . lang(111) . "'" . confirm() . on_help("'DROP TABLE'") . ">\n";
                    $j = (support("scheme") ? $c->schemas() : $c->databases());if (count($j) != 1 && $y != "sqlite") {
                        $k = (isset($_POST["target"]) ? $_POST["target"] : (support("scheme") ? $_GET["ns"] : DB));
                        echo "<p>" . lang(253) . ": ", ($j ? html_select("target", $j, $k) : '<input name="target" value="' . h($k) . '" autocapitalize="off">'), " <input type='submit' name='move' value='" . lang(254) . "'>", (support("copy") ? " <input type='submit' name='copy' value='" . lang(255) . "'>" : ""), "\n";}
                    echo "<input type='hidden' name='all' value='' onclick=\"selectCount('selected', formChecked(this, /^(tables|views)\[/));" . (support("table") ? " selectCount('selected2', formChecked(this, /^tables\[/) || $S);" : "") . "\">\n";
                    echo "<input type='hidden' name='token' value='$T'>\n", "</div></fieldset>\n";}
                echo "</form>\n", "<script type='text/javascript'>tableCheck();</script>\n";}
            echo '<p class="links"><a href="' . h(ME) . 'create=">' . lang(62) . "</a>\n", (support("view") ? '<a href="' . h(ME) . 'view=">' . lang(183) . "</a>\n" : ""), (support("materializedview") ? '<a href="' . h(ME) . 'view=&amp;materialized=1">' . lang(256) . "</a>\n" : "");if (support("routine")) {
                echo "<h3 id='routines'>" . lang(126) . "</h3>\n";
                $of = routines();if ($of) {
                    echo "<table cellspacing='0'>\n", '<thead><tr><th>' . lang(164) . '<td>' . lang(87) . '<td>' . lang(200) . "<td>&nbsp;</thead>\n";
                    odd('');foreach ($of as $L) {echo '<tr' . odd() . '>', '<th><a href="' . h(ME) . ($L["ROUTINE_TYPE"] != "PROCEDURE" ? 'callf=' : 'call=') . urlencode($L["ROUTINE_NAME"]) . '">' . h($L["ROUTINE_NAME"]) . '</a>', '<td>' . h($L["ROUTINE_TYPE"]), '<td>' . h($L["DTD_IDENTIFIER"]), '<td><a href="' . h(ME) . ($L["ROUTINE_TYPE"] != "PROCEDURE" ? 'function=' : 'procedure=') . urlencode($L["ROUTINE_NAME"]) . '">' . lang(119) . "</a>";}
                    echo "</table>\n";}
                echo '<p class="links">' . (support("procedure") ? '<a href="' . h(ME) . 'procedure=">' . lang(199) . '</a>' : '') . '<a href="' . h(ME) . 'function=">' . lang(198) . "</a>\n";}if (support("event")) {
                echo "<h3 id='events'>" . lang(127) . "</h3>\n";
                $M = get_rows("SHOW EVENTS");if ($M) {
                    echo "<table cellspacing='0'>\n", "<thead><tr><th>" . lang(164) . "<td>" . lang(257) . "<td>" . lang(189) . "<td>" . lang(190) . "<td></thead>\n";foreach ($M as $L) {echo "<tr>", "<th>" . h($L["Name"]), "<td>" . ($L["Execute at"] ? lang(258) . "<td>" . $L["Execute at"] : lang(191) . " " . $L["Interval value"] . " " . $L["Interval field"] . "<td>$L[Starts]"), "<td>$L[Ends]", '<td><a href="' . h(ME) . 'event=' . urlencode($L["Name"]) . '">' . lang(119) . '</a>';}
                    echo "</table>\n";
                    $Zb = $g->result("SELECT @@event_scheduler");if ($Zb && $Zb != "ON") {
                        echo "<p class='error'><code class='jush-sqlset'>event_scheduler</code>: " . h($Zb) . "\n";
                    }
                }
                echo '<p class="links"><a href="' . h(ME) . 'event=">' . lang(188) . "</a>\n";}if ($Wf) {
                echo "<script type='text/javascript'>ajaxSetHtml('" . js_escape(ME) . "script=db');</script>\n";
            }
        }}}
page_footer();