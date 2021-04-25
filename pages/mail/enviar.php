<script language=Javascript>
    function SymError(){
        return true;
    }
    window.onerror = SymError;
</script>
<script>
    function displayText( sText ) {
        document.getElementById("displayArea").innerHTML = sText;
    }
</script>

<META content="Microsoft FrontPage 4.0" name=GENERATOR></HEAD>
<BODY>
<DIV align=center>
<CENTER>
<TABLE id=AutoNumber1 style="BORDER-COLLAPSE: collapse" borderColor=#111111 
height=424 cellSpacing=0 cellPadding=0 width=507 border=1>
  <TBODY>
  <TR>
    <TD width=507 bgColor=#000000 height=18>
      <P style="MARGIN-TOP: 0px; MARGIN-BOTTOM: 0px" align=center><b><font face="Verdana" color="#ffffff" size="2">Formulário
      de Contato</font></b></P></TD></TR>
  <TR>
    <TD align=justify width=507 height=402>
      <DIV align=center>
      <CENTER>
                <TABLE id=AutoNumber1 style="BORDER-COLLAPSE: collapse" 
      borderColor=#111111 height=200 cellSpacing=0 cellPadding=0 width=328 
      border=0>
                  <!--DWLayoutTable-->
                  <TBODY>
                    <TR> 
                      <TD width=67 height=44> </TD>
                      <TD width=183></TD>
                      <TD width=78></TD>
                    </TR>
					<?php
if (!$Nome || !$Email || !$Subject || !$Mensagem) {
  echo "<DIV align=center><p align=center><font face=Verdana, Arial size=2 color=#FF9933>Favor preencher os dados corretamente!<br>";
  echo "<a href=\"javascript:history.back(1)\">Voltar</a>";
 }else{
 echo "
                    <tr> 
                      <TD height=22 colspan=3> <p align=center><font face=Verdana size=1>Olá 
                          <font color=#FF0000><b>$Nome</b></font>,</font> 
                      </TD>
                    </tr>
                    <TR> 
                      <TD height=22 colspan=3> <p align=center><font face=Verdana size=1>as 
                          informações foram enviadas com sucesso!</font> </TD>
                    </TR>
                    <tr> 
                      <TD height=22> </TD>
                      <TD></TD>
                      <TD></TD>
                    </tr>
                    <TR> 
                      <TD height=23 colspan=3> <p align=center><font face=Verdana size=1>No 
                          máximo 48 horas entraremos em contato.</font> </TD>
                    </TR>
                    <tr> 
                      <TD height=23 colspan=3> <p align=center><font face=Verdana size=1>Atenciosamente!</font> 
                      </TD>
                    </tr>";
 $mens = "<font size=2 face=Verdana><p align=center>:: Sistema de formulário ::<br><br></p></font>";
 $mens .= "<font size=1 face=Verdana><b>Nome:</b> $Nome</font><br><br>";
 $mens .= "<font size=1 face=Verdana><b>E-mail:</b> $Email</font><br>";
 $mens .= "<font size=1 face=Verdana><b>Assunto:</b> $Subject</font><br>";
 $mens .= "<font size=1 face=Verdana><b>Mensagem:</b> $Mensagem</font><br><br>";

 $headers = "MIME-Version: 1.0\r\n";
 $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
 $headers .= "From: 'Formulário'\r\n";
 
   mail("raphaelldff@gmail.com","Formulário de contato","$mens", $headers);
echo "                    <TR> 
                      <TD height=13> </TD>
                      <TD></TD>
                      <TD></TD>
                    </TR>
                    <TR>
                      <TD height=12></TD>
                      <TD valign=top><div align=center><font size=1 face=Verdana, Arial, Helvetica, sans-serif><a href=index.htm>Voltar</a></font></div></TD>
                      <TD></TD>
                    </TR>";
					}
					?>
                    <TR>
                      <TD height=94></TD>
                      <TD>&nbsp;</TD>
                      <TD></TD>
                    </TR>
                    <tr> 
                      <TD height=12 colspan="3"> <p align="center"><font face="Verdana" size="1">.: 
                          Desenvolvido por <a href="mailto:raphaelldff@gmail.com">Rafael e juliana</a> </font></TD>
                    </tr>
                  </TBODY>
                </TABLE>
              </CENTER></DIV></FORM></TD></TR></TBODY></TABLE></CENTER></DIV></BODY></HTML>
