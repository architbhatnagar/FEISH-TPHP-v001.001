<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts.Email.html
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
    <head>
        <title><?php echo $this->fetch('title'); ?></title>
        <style type="text/css">
            .ReadMsgBody {width: 100%; background-color: #ffffff;}
            .ExternalClass {width: 100%; background-color: #ffffff;}
            body     {width: 100%; background-color: #ffffff; margin:0; padding:0; -webkit-font-smoothing: antialiased;font-family: Arial, Helvetica, sans-serif}
            table {border-collapse: collapse;}

            @media only screen and (max-width: 640px)  {
                body[yahoo] .deviceWidth {width:440px!important; padding:0;}    
                body[yahoo] .center {text-align: center!important;}  
            }

            @media only screen and (max-width: 479px) {
                body[yahoo] .deviceWidth {width:280px!important; padding:0;}    
                body[yahoo] .center {text-align: center!important;}  
            } 
            .bg_cust_color{
                background-color: red;
            }
        </style>
    </head> 

    <body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" yahoo="fix" style="font-family: Arial, Helvetica, sans-serif">

        <!-- Wrapper -->
        <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
            <tr>
                <td width="100%" valign="top" bgcolor="#ffffff" style="padding-top:20px">

                    <!--Start Header-->
                    <table width="700" bgcolor="#fff" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
                        <tr>
                            <td style="padding: 6px 0px 0px">
                                <table width="680" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
                                    <tr>
                                        <td width="100%" >
                                            <!--Start logo-->
                                            <table  border="0" cellpadding="0" cellspacing="0" align="left" class="deviceWidth">
                                                <tr>
                                                    <td class="center" style="padding: 10px 0px 10px 0px">
                                                        <a href="<?php echo Router::url('/', true); ?>">
                                                            <img style="padding-left: 10px;" src="<?php echo Router::url('/', true) . 'img/front/logo.png'; ?> " border="0" height="60" width="210">
                                                        </a>
                                                    </td>
                                                </tr>
                                            </table> 
                                            <!--End logo--> 

                                            <!--Start nav-->
                                            <table  border="0" cellpadding="0" cellspacing="0" align="right" class="deviceWidth">
                                                <tr>
                                                    <td  class="center" style="font-size: 13px; color: #272727; font-weight: light; text-align: center; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 10px 0px 10px 0px;">
                                                        <a href="<?php echo Router::url('/', true); ?>" style="text-decoration: none; color: #3b3b3b;">HOME</a>
                                                        &nbsp; &nbsp;
                                                        <a href="<?php echo Router::url('/', true) . 'categories' . '/category_list'; ?> " style="text-decoration: none; color: #3b3b3b;">CATEGORIES</a>
                                                        &nbsp; &nbsp;
                                                        <a href="<?php echo Router::url('/', true) . 'users' . '/contactus'; ?>" style="text-decoration: none; color: #3b3b3b;">CONTACT US</a>
                                                        &nbsp; &nbsp;
                                                        <a href="<?php echo Router::url('/', true) . 'users' . '/aboutus'; ?>" style="text-decoration: none; color: #3b3b3b;">ABOUT US</a>                            
                                                    </td>
                                                </tr>
                                            </table><!--End nav-->
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table> 
                    <!--End Header--> 
                    <table width="700" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
                        <tr style="padding: 20px 0px 10px 0px">
                            <td width="100%" bgcolor="white" class="center" style="padding: 10px 0px 10px 0px">
                                <?php echo $this->fetch('content'); ?>
                            </td>
                        </tr>
                    </table>
                    <!--Start Two Blocks-->
                    <!--End Two Blocks -->
                    <div style="height:15px">&nbsp;</div><!-- divider -->
                    <!--Start Three Blocks-->
            </tr><!-- End 3 Images Row 1 -->
        </table>   

        <table width="700"  border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth"  > 
            <tr>
                <td  bgcolor="#ffffff" class="center" style="font-size: 12px; color: #687074; font-weight: bold; text-align: center; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 50px 0px 50px; " >
                    <strong>Copyright</strong> decisiondatabases.com &copy; <?php echo date("Y", strtotime("-1 year")); ?>-<?php echo date("Y"); ?>                         
                </td>
            </tr>
        </table>
    </body>

</html>