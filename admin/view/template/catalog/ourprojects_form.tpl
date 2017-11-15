<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-posts" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $heading_title; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-posts" class="form-horizontal">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
						<li><a href="#tab-image" data-toggle="tab"><?php echo $tab_image; ?></a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="tab-general">
								<ul class="nav nav-tabs" id="language">
									<?php foreach ($languages as $language) { ?>
									<li><a href="#language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
									<?php } ?>
								</ul>
								<div class="tab-content">
								<?php foreach ($languages as $language) { ?>
								<div class="tab-pane" id="language<?php echo $language['language_id']; ?>">
									<div class="form-group required">
									<label class="col-sm-2 control-label" for="input-title<?php echo $language['language_id']; ?>"><?php echo $text_title; ?></label>
									<div class="col-sm-10">
										<input type="text" name="posts[<?php echo $language['language_id']; ?>][title]" value="<?php echo isset($posts[$language['language_id']]) ? $posts[$language['language_id']]['title'] : ''; ?>" placeholder="<?php echo $text_title; ?>" id="input-title<?php echo $language['language_id']; ?>" class="form-control" />
									</div>
									</div>
									<div class="form-group">
									<label class="col-sm-2 control-label" for="input-model"><?php echo $text_model; ?></label>
									<div class="col-sm-10">
										<input type="text" name="posts[<?php echo $language['language_id']; ?>][model]" value="<?php echo isset($posts[$language['language_id']]) ? $posts[$language['language_id']]['model'] : ''; ?>" placeholder="<?php echo $text_model; ?>" id="input-title<?php echo $language['language_id']; ?>" class="form-control" />
									</div>
									</div>
								</div>
								<?php } ?>
								</div>
								<div class="form-group">
								<label class="col-sm-2 control-label" for="input-image">Превью:</label>
								<div class="col-sm-10">
									<a href="" data-toggle="image" id="thumb-image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $no_image; ?>" /></a>
									<input type="hidden" name="image" value="<?php echo $image; ?>" id="input-image" />
								</div>
								</div>
								<div class="form-group">
								<label class="col-sm-2 control-label" for="input-full-image">Полное изображение:</label>
								<div class="col-sm-10">
									<a href="" id="full-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $preview; ?>" alt="" title="" data-placeholder="<?php echo $no_image; ?>" /></a>
									<input type="hidden" name="full_image" value="<?php echo $full_image; ?>" id="input-full-image" />
								</div>
								</div> 
								<div class="form-group">
								<label class="col-sm-2 control-label" for="input-keyword"><?php echo $text_keyword; ?></label>
								<div class="col-sm-10">
									<input type="text" name="keyword" value="<?php echo $keyword; ?>" placeholder="<?php echo $text_keyword; ?>" id="input-keyword" class="form-control" />
								</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="input-status"><?php echo $text_status; ?></label>
									<div class="col-sm-10">
										<select name="status" id="input-status" class="form-control">
										<?php if ($status) { ?>
										<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
										<option value="0"><?php echo $text_disabled; ?></option>
										<?php } else { ?>
										<option value="1"><?php echo $text_enabled; ?></option>
										<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
										<?php } ?>
										</select>
									</div>
								</div>
						</div>
						<div class="tab-pane" id="tab-image">
							<div class="table-responsive">
								<table id="images" class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<td class="text-left"><?php echo $entry_image; ?></td>
											<td class="text-right"><?php echo $entry_sort_order; ?></td>
											<td></td>
										</tr>
									</thead>
									<tbody>
										<?php $image_row = 0; ?>
										<?php foreach ($posts_images as $posts_image) { ?>
										<tr id="image-row<?php echo $image_row; ?>">
											<td class="text-left"><a href="" id="thumb-image<?php echo $image_row; ?>" data-toggle="image" class="img-thumbnail"><img src="<?php echo $posts_image['thumb']; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a><input type="hidden" name="posts_image[<?php echo $image_row; ?>][image]" value="<?php echo $posts_image['image']; ?>" id="input-image<?php echo $image_row; ?>" /></td>
											<td class="text-right"><input type="text" name="posts_image[<?php echo $image_row; ?>][sort_order]" value="<?php echo $posts_image['sort_order']; ?>" placeholder="<?php echo $entry_sort_order; ?>" class="form-control" /></td>
											<td class="text-left"><button type="button" onclick="$('#image-row<?php echo $image_row; ?>').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
										</tr>
										<?php $image_row++; ?>
										<?php } ?>
									</tbody>
									<tfoot>
										<tr>
											<td colspan="2"></td>
											<td class="text-left"><button type="button" onclick="addImage();" data-toggle="tooltip" title="<?php echo $button_image_add; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>
					</div>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$('#language a:first').tab('show');
</script>

<script type="text/javascript"><!--
var image_row = <?php echo $image_row; ?>;

function addImages(files, path, item) {
	html  = '<tr class="separator" id="image-row' + image_row + '">';
	html += '  <td class="text-left"><a href="" id="thumb-image' + image_row + '"data-toggle="image" class="img-thumbnail"><img src="' + files + '" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /><input type="hidden" name="posts_image[' + image_row + '][image]" value="' + path + '" id="input-image' + image_row + '" /></td>';
	html += '  <td class="text-right"><input type="text" name="posts_image[' + image_row + '][sort_order]" value="' + item + '" placeholder="<?php echo $entry_sort_order; ?>" class="form-control" /></td>';
	html += '  <td class="text-left"><button type="button" onclick="$(\'#image-row' + image_row  + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
	html += '</tr>';

	$('#images tbody').append(html);

	image_row++;
}

function addImage() {
	html  = '<tr id="image-row' + image_row + '">';
	html += '  <td class="text-left"><a href="" id="thumb-image' + image_row + '"data-toggle="image" class="img-thumbnail"><img src="<?php echo $placeholder; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /><input type="hidden" name="posts_image[' + image_row + '][image]" value="" id="input-image' + image_row + '" /></td>';
	html += '  <td class="text-right"><input type="text" name="posts_image[' + image_row + '][sort_order]" value="" placeholder="<?php echo $entry_sort_order; ?>" class="form-control" /></td>';
	html += '  <td class="text-left"><button type="button" onclick="$(\'#image-row' + image_row  + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
	html += '</tr>';

	$('#images tbody').append(html);

	image_row++;
}
//--></script>
<?php echo $footer; ?>