<?php
if (!defined('_source')) die("Error");
$a = (isset($_REQUEST['a'])) ? addslashes($_REQUEST['a']) : "";

switch ($a) {
	case "man":
		showdulieu();
		$template = @$_REQUEST['p'] . "/hienthi";
		break;
	case "add":
		$extra = getExtra();
		showdulieu();
		$template = @$_REQUEST['p'] . "/them";
		break;
	case "edit":
		$extra = getExtra();
		showdulieu();
		$template = @$_REQUEST['p'] . "/them";
		break;
	case "export_list":
		export_file();
		break;
	case "save":
		luudulieu();
		break;
	case "delete":
		xoadulieu();
		break;
	case "delete_all":
		xoadulieu_mang();
		break;
	default:
		$template = "index";
}


function getExtra()
{
	global $d;
	$str['thuonghieu'] = $d->o_fet("select * from #_extra where type = 0 and hide=1 order by stt asc,id desc");
	$str['model'] = $d->o_fet("select * from #_extra where type = 1 and hide=1 order by stt asc,id desc");
	$str['nam'] = $d->o_fet("select * from #_extra where type = 2 and hide=1 order by stt asc,id desc");
	return $str;
}

function showdulieu()
{
	global $d, $items, $paging, $loai;
	$loai = $d->array_category(0, '', $_GET['id_loai'], 3);

	if ($_REQUEST['a'] == 'man') {

		//show du lieu
		if (isset($_GET['id_loai']) && $_GET['id_loai'] <> '') {

			if ($_GET['id_loai'] == 0) {
				$items = $d->o_fet("select * from #_sanpham where style=0 order by so_thu_tu asc, id desc");
			} else {
				$id_loai = $_GET['id_loai'] . $d->findIdSub($_GET['id_loai']);
				$items = $d->o_fet("select * from #_sanpham where FIND_IN_SET(id_loai,'$id_loai') <> 0 and style=0 order by so_thu_tu asc, id desc");
			}
		} else if (isset($_GET['seach'])) {
			$seach = addslashes($_GET['seach']);
			$key = (isset($_GET['key'])) ? addslashes($_GET['key']) : "";
			if ($seach == 'id') {
				$items = $d->o_fet("select * from #_sanpham where id = '" . $key . "' and style=0");
			} else if ($seach == 'name') {
				$items = $d->o_fet("select * from #_sanpham where ten_vn like '%" . $key . "%' and style=0");
			} else {
				$items = $d->o_fet("select * from #_sanpham where ma_sp like '%" . $key . "%' and style=0");
			}
		} else $items = $d->o_fet("select * from #_sanpham where style=0 order by ngay_dang desc");

		// foreach ($items as $key => $value) {
		// 	watermark_image($value['hinh_anh'], '../img_data/images/');
		// }
		if (isset($_GET['hienthi'])) {
			$maxR = $d->lay_show_hienthi(addslashes($_GET['hienthi']));
		} else $maxR = 20;
		// phan trang
		$page = isset($_GET['page']) ? addslashes($_GET['page']) : 1;
		$url = $d->fullAddress();
		$maxP = $maxR;
		$paging = $d->phantrang($items, $url, $page, $maxR, $maxP, 'classunlink', 'classlink', 'page');
		$items = $paging['source'];
		//
	} else {

		//lay noi dung theo id
		if (isset($_REQUEST['id'])) {
			@$id = addslashes($_REQUEST['id']);
			$items = $d->o_fet("select * from #_sanpham where id =  '" . $id . "'");
			$loai = $d->array_category(0, '', $items[0]['id_loai'], 3);
		}
	}
}

function luudulieu()
{
	global $d;


	$id = (isset($_REQUEST['id'])) ? addslashes($_REQUEST['id']) : "";
	$file_name = $d->fns_Rand_digit(0, 9, 12);
	if ($id != '') {
		if (@$file = $d->upload_image("file2", '', '../img_data/images/', $file_name)) {
			$hinhanh = $d->o_fet("select * from #_sanpham where id = '" . $id . "'");
			unlink('../img_data/images/' . $hinhanh[0]['hinh_anh']);
			$data['hinh_anh'] = $file;
			// watermark_image($file, '../img_data/images/');
			// $d->create_thumb($file,200,200,'../img_data/images/',time(),'../img_data/thumb/');
		}

		$data['id_loai'] = addslashes($_POST['id_loai']);
		$data['ma_sp'] = $d->clear(addslashes($_POST['ma_sp']));

		$data['ten_vn'] = $d->clear(addslashes($_POST['ten_vn']));
		$data['ten_us'] = $d->clear(addslashes($_POST['ten_us']));
		$data['ten_ch'] = $d->clear(addslashes($_POST['ten_ch']));

		$data['mo_ta_vn'] = $d->clear(addslashes($_POST['mo_ta_vn']));
		$data['mo_ta_us'] = $d->clear(addslashes($_POST['mo_ta_us']));
		$data['mo_ta_ch'] = $d->clear(addslashes($_POST['mo_ta_ch']));
		//$data['noi_dung_vn'] = $d->clear(addslashes($_POST['noi_dung_vn']));
		//$data['noi_dung_us'] = $d->clear(addslashes($_POST['noi_dung_us']));
		$data['gia'] = $d->clear(addslashes($_POST['gia']));
		$data['khuyen_mai'] = $d->clear(addslashes($_POST['khuyen_mai']));

		$data['thong_tin_vn'] = $d->clear(addslashes($_POST['thong_tin_vn']));
		$data['thong_so_vn'] = $d->clear(addslashes($_POST['thong_so_vn']));
		$data['video'] = $d->clear(addslashes($_POST['video']));
		$data['doc'] = $d->clear(addslashes($_POST['doc']));


		$data['alias_vn'] = $d->clear(addslashes($_POST['alias_vn']));
		if ($d->checkLink($data['alias_vn'], "alias_vn", $id) && $data['alias_vn'] != '') {
			$data['alias_vn'] .= "-" . rand(10, 999);
		}

		$data['alias_us'] = $d->clear(addslashes($_POST['alias_us']));
		if ($d->checkLink($data['alias_us'], "alias_us", $id) && $data['alias_us'] != '') {
			$data['alias_us'] .= "-" . rand(10, 999);
		}

		$data['alias_ch'] = $d->clear(addslashes($_POST['alias_ch']));
		if ($d->checkLink($data['alias_ch'], "alias_ch", $id) && $data['alias_ch'] != '') {
			$data['alias_ch'] .= "-" . rand(10, 999);
		}

		$data['title_vn'] = $d->clear(addslashes($_POST['title_vn']));
		$data['title_us'] = $d->clear(addslashes($_POST['title_us']));
		$data['title_ch'] = $d->clear(addslashes($_POST['title_ch']));

		$data['keyword'] = $d->clear(addslashes($_POST['keyword']));
		$data['des'] = $d->clear(addslashes($_POST['des']));

		$data['extra0'] = addslashes($_POST['extra0']);
		$data['hien_thi'] = isset($_POST['hien_thi']) ? 1 : 0;
		$data['tieu_bieu'] = isset($_POST['tieu_bieu']) ? 1 : 0;
		$data['sp_moi'] = isset($_POST['sp_moi']) ? 1 : 0;
		$data['sp_hot'] = isset($_POST['sp_hot']) ? 1 : 0;
		$data['con_hang'] = isset($_POST['con_hang']) ? 1 : 0;
		$d->reset();
		$d->setTable('#_sanpham');
		$d->setWhere('id', $id);
		if ($d->update($data)) {
			//add thong so
			$hang = trim($hang, ",");
			/////up hinh
			for ($i = 1; $i <= 15; $i++) {
				if (isset($_POST['txt_up_' . $i]) && $_POST['txt_up_' . $i] == 1) {
					$file_name = $d->fns_Rand_digit(0, 9, 12);
					if (@$file = $d->upload_image("file_" . $i, '', '../img_data/images/', $file_name)) {
						$data_hinh['hinh_anh'] = $file;
						$data_hinh['title'] = $_REQUEST['title' . $i];
						$data_hinh['id_sp'] = $id;
						$d->reset();
						$d->setTable('#_sanpham_hinhanh');
						$d->insert($data_hinh);
					}
				}
			}

			///
			$d->redirect("index.php?p=san-pham&a=man&page=" . @$_REQUEST['page'] . "");
		} else {
			echo mysql_error();
			$d->transfer("Cập nhật dữ liệu bị lỗi", "index.php?p=san-pham&a=man");
		}
	} else {
		if (@$file = $d->upload_image("file2", '', '../img_data/images/', $file_name)) {
			$data['hinh_anh'] = $file;
			// watermark_image($file, '../img_data/images/');
		}
		$data['id_loai'] = addslashes($_POST['id_loai']);
		$data['ma_sp'] = $d->clear(addslashes($_POST['ma_sp']));

		$data['ten_vn'] = $d->clear(addslashes($_POST['ten_vn']));
		$data['ten_us'] = $d->clear(addslashes($_POST['ten_us']));
		$data['ten_ch'] = $d->clear(addslashes($_POST['ten_ch']));

		$data['mo_ta_vn'] = $d->clear(addslashes($_POST['mo_ta_vn']));
		$data['mo_ta_us'] = $d->clear(addslashes($_POST['mo_ta_us']));
		$data['mo_ta_ch'] = $d->clear(addslashes($_POST['mo_ta_ch']));

		$data['gia'] = $d->clear(addslashes($_POST['gia']));
		$data['khuyen_mai'] = $d->clear(addslashes($_POST['khuyen_mai']));
		$data['extra0'] = addslashes($_POST['extra0']);
		$data['thong_tin_vn'] = $d->clear(addslashes($_POST['thong_tin_vn']));
		$data['thong_so_vn'] = $d->clear(addslashes($_POST['thong_so_vn']));
		$data['video'] = $d->clear(addslashes($_POST['video']));
		$data['doc'] = $d->clear(addslashes($_POST['doc']));



		$data['alias_vn'] = $d->clear(addslashes($_POST['alias_vn']));
		if ($d->checkLink($data['alias_vn'], "alias_vn", $id) && $data['alias_vn'] != '') {
			$data['alias_vn'] .= "-" . rand(10, 999);
		}

		$data['alias_us'] = $d->clear(addslashes($_POST['alias_us']));
		if ($d->checkLink($data['alias_us'], "alias_us", $id) && $data['alias_us'] != '') {
			$data['alias_us'] .= "-" . rand(10, 999);
		}

		$data['alias_ch'] = $d->clear(addslashes($_POST['alias_ch']));
		if ($d->checkLink($data['alias_ch'], "alias_ch", $id) && $data['alias_ch'] != '') {
			$data['alias_ch'] .= "-" . rand(10, 999);
		}

		$data['title_vn'] = $d->clear(addslashes($_POST['title_vn']));
		$data['title_us'] = $d->clear(addslashes($_POST['title_us']));
		$data['title_ch'] = $d->clear(addslashes($_POST['title_ch']));

		$data['keyword'] = $d->clear(addslashes($_POST['keyword']));
		$data['des'] = $d->clear(addslashes($_POST['des']));

		$data['style'] = 0;
		$data['hien_thi'] = isset($_POST['hien_thi']) ? 1 : 0;
		$data['tieu_bieu'] = isset($_POST['tieu_bieu']) ? 1 : 0;
		$data['sp_moi'] = isset($_POST['sp_moi']) ? 1 : 0;
		$data['sp_hot'] = isset($_POST['sp_hot']) ? 1 : 0;
		$data['con_hang'] = isset($_POST['con_hang']) ? 1 : 0;

		$data['ngay_dang'] = time();
		if ($_POST['tang_kem'] != "") {
			$tang_kem = ',' . implode(',', $_POST['tang_kem']) . ',';
			$data['tang_kem'] = $tang_kem;
		}
		$d->setTable('#_sanpham');
		if ($idsp = $d->insert($data)) {
			// $idsp = $idInsert;
			/////up hinh		
			for ($i = 1; $i <= 15; $i++) {
				$file_name = $d->fns_Rand_digit(0, 9, 12);
				if (isset($_POST['txt_up_' . $i]) && $_POST['txt_up_' . $i] == 1) {
					if (@$file = $d->upload_image("file_" . $i, '', '../img_data/images/', $file_name)) {
						$data_hinh['hinh_anh'] = $file;
						$data_hinh['title'] = $_REQUEST['title' . $i];
						$data_hinh['id_sp'] = $idsp;
						$d->reset();
						$d->setTable('#_sanpham_hinhanh');
						$d->insert($data_hinh);
					}
				}
			}

			$d->redirect("index.php?p=san-pham&a=man");
		} else {
			echo mysql_error();
			$d->transfer("Thêm dữ liệu bị lỗi!", "index.php?p=san-pham&a=man");
		}
	}
}

function export_file()
{
	global $d;
	if (isset($_REQUEST['ex_id'])) {
		$id = $_REQUEST['ex_id'];
		$items = $d->o_fet("select * from #_user_question where id_event = $id order by id asc");
		$even  = $d->simple_fetch("select * from #_sukien where id = $id order by id asc");
	}
	$date = date("d-m-Y");
	$filename = $d->bodautv($even['ten_vn']) . "-" . $date;
	$ex_file .= '
	<table border="1">
	<thead>
		<tr bgcolor="#FFFF99"><th colspan="7">' . $even['ten_vn'] . '</th></tr>
		<tr>
			<th>Trả lời đúng</th>
			<th>STT</th>
			<th>Thành viên</th>
			<th>Email</th>
			<th>Điện thoại</th>
			<th>Câu trả lời</th>
			<th>Gửi lúc</th>
		</tr>
	</thead>
	<tbody>
	';
	$count = count($items);
	for ($i = 0; $i < $count; $i++) {

		$user = $d->simple_fetch("select * from #_member where id={$items[$i]['id_user']}");

		if ($items[$i]['best_true'] == 1) {
			$best = "Trả lời đúng";
		} else {
			$best = "chưa đúng";
		};

		$ex_file .= '
		<tr>
			<td>' . $best . '</td>
			<td align="center">' . $i . '</td>

			<td>' . $user['name'] . '</td>
			<td>' . $user['email'] . '</td>
			<td>' . $user['phone'] . '</td>
			
			<td>' . nl2br($items[$i]['noidung']) . '</td>

			<td>' . date('h:i:s d-m-Y', $items[$i]['create_at']) . '></td>

		</tr>
		';
	}
	$ex_file .= '
	</tbody>
	</table>
	';
	header("Content-type: application/xls");
	header("Content-Disposition: attachment; filename=$filename.xls");
	header("Pragma: no-cache");
	header("Expires: 0");

	echo $ex_file;
	$d->redirect("index.php?p=su-kien&view_list&id=" . $id . "&page");
}

function xoadulieu()
{
	global $d;
	if (isset($_GET['id'])) {
		$id =  addslashes($_GET['id']);
		//xoa img
		$hinhanh = $d->o_fet("select * from #_sanpham where id = '" . $id . "'");
		foreach ($hinhanh as $ha) {
			@unlink('../img_data/images/' . $ha['hinh_anh']);
		}

		//xoa size
		// $d->o_que("delete from #_sanpham_detail where id_sp = '".$id."'");
		//

		// xoa anh chi tiet
		$hinhanh_chitiet = $d->o_fet("select * from #_sanpham_hinhanh where id_sp = '" . $id . "'");
		$d->o_que("delete from #_sanpham_hinhanh where id_sp = '" . $id . "'");
		foreach ($hinhanh_chitiet as $hact) {
			@unlink('../img_data/images/' . $hact['hinh_anh']);
		}
		// end
		//xoa hinhanh
		$hinhanh = $d->o_fet("select * from #_sanpham_hinhanh where id_sp = '" . $id . "'");
		foreach ($hinhanh as $ha) {
			@unlink('../img_data/images/' . $ha['hinh_anh']);
		}
		// end
		if ($d->o_que("delete from #_sanpham where id='" . $id . "'")) {
			$d->redirect("index.php?p=san-pham&a=man&page=" . @$_REQUEST['page'] . "");
		} else
			$d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=san-pham&a=man");
	} else $d->transfer("Không nhận được dữ liệu", "index.php?p=san-pham&a=man");
}

function xoadulieu_mang()
{
	global $d;
	if (isset($_POST['chk_child'])) {
		$chuoi = "";
		foreach ($_POST['chk_child'] as $val) {
			$chuoi .= $val . ',';
		}
		$chuoi = trim($chuoi, ',');
		//lay danh sách idsp theo chuoi
		$hinhanh = $d->o_fet("select * from #_sanpham where id in ($chuoi)");
		$hinhanh2 = $d->o_fet("select * from #_sanpham_hinhanh where id_sp in ($chuoi)");
		if ($d->o_que("delete from #_sanpham where id in ($chuoi)")) {
			//xoa hình ảnh
			foreach ($hinhanh as $ha) {
				@unlink('../img_data/images/' . $ha['hinh_anh']);
			}
			//xoa size
			// $d->o_que("delete from #_sanpham_detail where id_sp in ($chuoi)");
			//
			// xoa anh chi tiet
			$hinhanh_chitiet = $d->o_fet("select * from #_sanpham_hinhanh where id_sp in ($chuoi)");
			$d->o_que("delete from #_sanpham_hinhanh where id_sp in ($chuoi)");
			foreach ($hinhanh_chitiet as $hact) {
				@unlink('../img_data/images/' . $hact['hinh_anh']);
			}
			//xoaha2
			foreach ($hinhanh2 as $ha) {
				@unlink('../img_data/images/' . $ha['hinh_anh']);
			}
			$d->redirect("index.php?p=san-pham&a=man&page=" . @$_REQUEST['page'] . "");
		} else $d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=san-pham&a=man");
	} else $d->redirect("index.php?p=san-pham&a=man&page=" . @$_REQUEST['page'] . "");
}
