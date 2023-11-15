<body style="font-family:sans-serif; background:#f6f6f6; padding:30px">
    <table class="body-wrap" style=" box-sizing: border-box; font-size: 14px; width: 100%;height:100%; margin: 0;min-height:400px; ">
	<tr style="box-sizing: border-box; font-size: 14px; margin: 0;">
		<td style="width:50%; background:#fff; padding:6px 20px;vertical-align:top">
		    <h3 style="color:#9b909f;text-transform:uppercase; margin-bottom:0">about my work</h3>
		    <p style="margin-top:5px"><?=(isset($work))?$work:''?></p>
		    <h3 style="color:#9b909f; text-transform:uppercase;margin-top:40px">best work</h3>
		    <div class="img-ww" style="width:100%; height:400px;">
		    <img src="<?=(isset($best_image))?$best_image:''?>" style="width:50%;">
		    </div>
		    <p style="font-weight:bolder; margin-bottom:0;font-size:15px"><?=(isset($best_title))?$best_title:''?></p>
		    <p style="margin-bottom:5px; margin-top:2px"><?=(isset($best_description))?$best_description:''?></p>
		    <a href="<?=isset($best_link)?$best_link:''?>" style="text-decoration:none; font-size:12px; color:#ccc" tartget="_blank">Learn More</a>
		    <h3 style="color:#9b909f;text-transform:uppercase; margin-top:40px; margin-bottom:0">terms of collaboration</h3>
		    <p style="margin-top:5px; "><?=(isset($terms_comditions))?$terms_comditions:''?></p>
		    <h3 style="color:#9b909f;text-transform:uppercase;margin-top:40px;margin-bottom:0"><?=(isset($collaboration_brand))?$collaboration_brand:''?></h3>
		    <p style="margin-top:5px"><span style="font-weight:bolder;">1. Rs 100</span> - Insta Posy X 2</p>
		</td>
		<td style="width:50%; background:#e9e2d0; padding:20px; vertical-align:top">
				<p style="margin-bottom:50px"><img src="<?=(isset($image))?$image:''?>" style="height:50px;width:50px; border-radius:50%"><span style="position:relative;top:-23px;left:10px"><?=(isset($name))?$name:''?></span></p>
				<h3 style="background:#6e5773; color:#fff;text-transform:uppercase; padding:10px">about me</h3>
				<p><?=(isset($about))?$about:''?></p>
				<p><span style="font-size:20px">@</span> <?=(isset($email))?$email:''?></p>
		</td>
			</tr>
		</table>  
		<!--<footer style="background:#6e5773;padding:10px">
		    <table width="100%">
		        <tr>
		            <td style="width:20%">
		                <p style="text-transform:uppercase; font-weight:bolder; padding-left:100px;color:#fff">logo</p>
		            </td>
		            <td style="width:30%">
		                <p style="text-transform:uppercase; font-weight:bolder;color:#fff; font-size:12px;margin-bottom:0;"> click below to view the ful profile</p>
		                <p style="font-size:12px; margin-top:5px;color:#fff;width:245px;text-align:center">Description link</p>
		            </td>
		        </tr>
		    </table>
		</footer>-->
</body>

		<style>
		    body
		    {
		        margin:0;
		    }
		</style>