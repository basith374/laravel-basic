<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width" />
  <title>Contact Letter</title>
</head>

<body>
  <!-- <style> -->
  <table style="font-family: Helvetica, Arial, sans-serif;color:#404040;background-color:#eee;" cellpadding="0" cellspacing="0" width="100%" height="100%">
    <tr>
      <td></td>
      <td width="500" style="background-color:#fff;">
        <table cellpadding="0" cellspacing="0" width="100%">
          <tr>
            <td align="center" valign="top" bgcolor="#36C26F">
              <center>
                <h1 style="color:#fff;">Contact Letter</h1>
              </center>
            </td>
          </tr>
          <tr>
            <td style="padding:0 20px;">
              <p style="margin-bottom:5px;color:#999;font-size:12px;"><i>Good Day! A visitor has sent a feedback/query.</i></p>
              @if($attachment)
              <p style="margin:0;color:#0B9142;font-size:12px;"><i>User has attached a file with this mail.</i></p>
              @endif
            </td>
          </tr>
          <tr>
            <td style="padding:0 20px;">
              <h3 style="margin-bottom:10px;">Name</h3>
              <p style="margin-top:0;">{{ $name }}</p>
            </td>
          </tr>
          <tr>
            <td style="padding:0 20px;">
              <h3 style="margin-bottom:10px;">Email</h3>
              <p style="margin-top:0;">{{ $email }}</p>
            </td>
          </tr>
          <tr>
            <td style="padding:0 20px;">
              <h3 style="margin-bottom:10px;">Message</h3>
              <p style="margin-top:0;">{{ $msg }}</p>
            </td>
          </tr>
          <tr>
            <td align="center">
              <p style="color:#ccc;font-size:11px;">This message was sent using the website contact form.</p>
            </td>
          </tr>
        </table>
      </td>
      <td></td>
    </tr>
  </table>
</body>
</html>
