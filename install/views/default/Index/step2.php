
<h1>运行环境检测</h1>

<div class="license">
	<div id="loader"></div>
</div>

<div class="step"  style="text-align: center;"><a href="<?=urlh('install/index.php', 'Index', 'step2', null, 'language=zh_CN')?>" class="button button-large" id="recheck">重新检测</a> <a href="<?=urlh('install/index.php', 'Index', 'step3', 'language=zh_CN')?>" class="button button-large button-disabled" id="next_step">下一步</a></div>


<div id="container">
	<script>

		var $topLoader = null;
		var topLoaderRunning = false;
		var check_data = '';
		var kb = 0;
		var totalKb = 999;


		$(function ()
		{
			$topLoader = $("#loader").percentageLoader({
				width: 256, height: 256, value: '检测中', controllable: true, progress: 0, onProgressUpdate: function (val)
				{
					$topLoader.setValue(Math.round(val * 100.0));
				}
			});

			check();
		});

		function  check()
		{
			$.ajax({
				type: "POST",
				url: "<?=urlh('install/index.php', 'Index', 'checkEnv', null, 'language=zh_CN&_pjax=1')?>",
				data: {},
				dataType: "html",
				beforeSend: function (XMLHttpRequest)
				{
					if (topLoaderRunning)
					{
						return;
					}
					topLoaderRunning = true;
					$topLoader.setProgress(0);
					//$topLoader.setValue('0kb');
					var animateFunc = function ()
					{
						kb += 17;
						$topLoader.setProgress(kb / totalKb);
						//$topLoader.setValue(kb.toString() + 'kb');

						if (kb < totalKb)
						{
							setTimeout(animateFunc, 25);
						}
						else
						{
							topLoaderRunning = false;

							$("#loader").slideToggle(function(){
								$("#loader").html(check_data);
							});

							$("#loader").slideToggle();
							//
						}
					}

					setTimeout(animateFunc, 25);

					//$("#divlist").html("正在加载数据");
				},

				success: function (msg)
				{
					check_data = msg;

					if (kb < 700)
					{
						kb = 700;
					}
				},

				complete: function (XMLHttpRequest, textStatus)
				{
					kb = 999;
				},

				error: function (e, x)
				{
					kb = 999;
				}
			});
		}

		$('#recheck').click(function(e){
			//e.preventDefault();
			//check();
		});

		$('#next_step').click(function(e){

			if ($('#next_step').hasClass('button-disabled'))
			{
				e.preventDefault();
				alert('服务器环境未通过检测!');
			}
			//
		});

	</script>
</div>
