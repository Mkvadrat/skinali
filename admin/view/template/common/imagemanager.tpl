<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
		<h4 class="modal-title"><?php echo $heading_title; ?></h4>
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="margin-top: -18px;">
			<i class="fa fa-times-circle-o"></i>
		</button>
    </div>
    <div class="modal-body">
		<div id="elfinder"></div>
    </div>
	<div class="modal-footer"></div>
  </div>
</div>

<!-- ADD ELFINDER LANGUAGE -->
<script type="text/javascript" src="view/javascript/imagemanager/elFinder/js/i18n/elfinder.ru.js"></script>

<script>
$(document).ready(function() {
	$('#elfinder').elfinder({
		url: 'index.php?route=common/imagemanager/init&token=<?php echo $token; ?>',
		width: '100%',
		lang: '<?php echo $language;?>',
		resizable: false,
		dragUploadAllow: true,
		destroyOnClose: false,
		commandsOptions: {
		  getfile: {
			multiple : true,
		  }
		},
		getFileCallback : function(files, fm) {
			if(count(files) > 1){
				$.each(files, function(item, file) {
					if ((file.read && file.hash)) {
						$.ajax({
							url: 'index.php?route=common/imagemanager/getTmb&thumb=' + encodeURIComponent(fm.path(file.hash)) + '&token=<?php echo $token; ?>',
							method: 'POST',
							dataType: 'json',
							async: false,
							success: function(data) {							
								parent.addImages(data.thumb, fm.path(file.hash), item);
								
								$('#modal-imagemanager').modal('hide');
							}
						});
					}
				});
			}else{	
				$.each(files, function(item, file) {
					if ((file.read && file.hash)) {
						$.ajax({
							url: 'index.php?route=common/imagemanager/getTmb&thumb=' + encodeURIComponent(fm.path(file.hash)) + '&token=<?php echo $token; ?>',
							method: 'POST',
							dataType: 'json',
							cache: false,
							success: function(data) {
								<?php if ($thumb) { ?>
									$('#<?php echo $thumb; ?>').find('img').attr('src', data.thumb);
								<?php } ?>
								<?php if ($target) { ?>
									$('#<?php echo $target; ?>').attr('value', fm.path(file.hash));
								<?php } ?>
								
								$('#modal-imagemanager').modal('hide');
							}
						});
					}
					
				});
			}
		},
		uiOptions : {
			toolbar : [
				['back', 'forward'],
				['reload'],
				['home', 'up'],
				['mkdir', 'upload'],
				['open', 'download', 'getfile'],
				['info'],
				['quicklook'],
				['copy', 'cut', 'paste'],
				['rm'],
				['duplicate', 'rename', 'edit', 'resize'],
				['extract', 'archive'],
				['search'],
				['view'],
				['help']
			]
		},
		contextmenu : {
			cwd    : ['reload', 'back', '|', 'upload', 'mkdir', 'paste', '|', 'info']
		}
	}); 
	
	function count(object) {
	  var count = 0; 
	  for(var prs in object){ 
			   if(object.hasOwnProperty(prs)) count++;
	  } 
	  return count; 
	}	
});
</script>