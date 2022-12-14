<?php
$textslide = $d->getImg(1130);
$product__nb = $d->getImg(1302);
$hinhnhxd__nb = $d->getImg(1319);
$projalist__nb = $d->getImg(1297);
$product__title = $d->simple_fetch("select * from #_category where id = 1302");
$product__link = $d->simple_fetch("select * from #_category where id = 1291");
$project__title = $d->simple_fetch("select * from #_category where id = 1310");
$thuonghieu__title = $d->simple_fetch("select * from #_category where id = 1311");
$sanpham__title = $d->simple_fetch("select * from #_category where id = 1312");
$loiich__title = $d->simple_fetch("select * from #_category where id = 1313");
$chungnhan__title = $d->simple_fetch("select * from #_category where id = 1296");
$why__title = $d->simple_fetch("select * from #_category where id = 1314");
$ex__title = $d->simple_fetch("select * from #_category where id = 1315");
$proja__title = $d->simple_fetch("select * from #_category where id = 1297");
$hinhanhxd__title = $d->simple_fetch("select * from #_category where id = 1319");
$khachhang__title = $d->simple_fetch("select * from #_category where id = 1316");
$tuvan__title = $d->simple_fetch("select * from #_category where id = 1317");
$quytrinhthicong__title = $d->simple_fetch("select * from #_category where id = 1318");

$dactinh = $d->simple_fetch("select * from #_category where id = 1291");
$video__item = $d->simple_fetch("select * from #_category where id = 1304");
$project__list = $d->o_fet("select * from #_tintuc where id_loai = 1310 and noi_bat = 1 order by so_thu_tu asc, id desc limit 0,6");
$sanpham__list = $d->o_fet("select * from #_sanpham where id_loai = 1312 and sp_hot = 1 order by so_thu_tu asc, id desc limit 0,6");
$loiich__list = $d->o_fet("select * from #_tintuc where id_loai = 1313 and noi_bat = 1 order by so_thu_tu asc, id desc limit 0,6");
$chungnhan__list = $d->o_fet("select * from #_tintuc where id_loai = 1296 and noi_bat = 1 order by so_thu_tu asc, id desc");
$why__list = $d->o_fet("select * from #_tintuc where id_loai = 1314 and noi_bat = 1 order by so_thu_tu asc, id desc limit 0,6");
$ex__list = $d->o_fet("select * from #_tintuc where id_loai = 1315 and noi_bat = 1 order by so_thu_tu asc, id desc limit 0,4");
$khachhang__list = $d->o_fet("select * from #_tintuc where id_loai = 1316 and noi_bat = 1 order by so_thu_tu asc, id desc");

$quytrinhthicong__list = $d->o_fet("select * from #_tintuc where id_loai = 1318 and noi_bat = 1 order by so_thu_tu asc, id desc limit 0,6");
?>
<div id="scroll1288"></div>
<div class="sliderShow" style="background-image: url(<?= URLPATH . 'img_data/images/' . $textslide[0]['picture'] ?>);">
    <div class="container__item__bs">
        <div class="slider__cont">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="conten__slider">
                        <?= $textslide[0]['body_' . $lang] ?>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <?php
                    $videoH = explode("v=", $textslide[0]['link']);
                    ?>
                    <div class="slide__video">
                        <div class="embed-responsive embed-responsive-4by3">
                            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?= $videoH[1] ?>" frameborder="0" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div id="scroll<?= $project__title["id"] ?>" class="project__k thuctrang">
    <div class="container__item__bs">
        <h2 class="title__home"><?= $project__title['title_' . $lang] ?></h2>
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="img__pro">
                    <img src="<?= URLPATH . 'img_data/images/' . $project__title['hinh_anh'] ?>" alt="<?= $project__title['title_' . $lang] ?>">
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="list__pro">
                    <ul>
                        <?php foreach ($project__list as $key => $item) {
                            $img = $item['hinh_anh'] ? URLPATH . 'img_data/images/' . $item['hinh_anh'] : URLPATH . 'templates/error/error.jpg';
                            if ($key + 1 < 10) {
                                $i = "0" + $key + 1;
                            } else {
                                $i = $key + 1;
                            }
                        ?>
                            <li data-id="<?= $item['id'] ?>" data-src="<?= $img ?>" onclick="handleSelectItem(this)"><label><?= $i ?></label><span><?= $item['ten_' . $lang] ?></span></li>
                        <?php } ?>
                    </ul>
                    <div class="compare" onclick="handleClickShowView(this)"><?= _sosanhgiaiphap ?></div>
                    <div class="view__compare" onclick="handleCloseShowView(this)">
                        <div class="close__view">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </div>
                        <div class="view__container">
                            <!-- content here -->
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- <div id="scroll<?= $thuonghieu__title["id"] ?>" class="thuonghieu" style="background-image: url(<?= URLPATH . 'img_data/images/' . $thuonghieu__title['hinh_anh'] ?>);">
    <div class="container__item__bs">
        <div class="thuonghieu__nb">
            <?= $thuonghieu__title['mo_ta_' . $lang] ?>
        </div>
    </div>
</div> -->

<!-- <section id="scroll<?= $sanpham__title["id"] ?>" class="prob">
    <div class="container__item__bs">
        <h2 class="title__home"><?= $sanpham__title['title_' . $lang] ?></h2>
        <div class="prob__content">
            <div class="row">
                <?php foreach ($sanpham__list as $key => $item) { ?>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="pro__item">
                            <div class="prob__img">
                                <img src="<?= URLPATH . 'img_data/images/' . $item['hinh_anh'] ?>" alt="<?= $item['ten_' . $lang] ?>">
                            </div>
                            <h1><?= $item['ten_' . $lang] ?></h1>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section> -->

<section id="scroll<?= $dactinh["id"] ?>" class="dactinh">
    <div class="container__item__bs">
        <h2 class="title__home"><?= $dactinh['title_' . $lang] ?></h2>
        <div class="del_">
            <?= $dactinh['mo_ta_' . $lang] ?>
        </div>
    </div>
</section>

<!-- <section id="scroll<?= $loiich__title["id"] ?>" class="loiich">
    <div class="container__item__bs">
        <h2 class="title__home"><?= $loiich__title['title_' . $lang] ?></h2>
        <div class="row">
            <?php foreach ($loiich__list as $key => $item) { ?>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="loiich__item">
                        <div class="loiich__img">
                            <img src="<?= URLPATH . 'img_data/images/' . $item['hinh_anh'] ?>" alt="<?= $item['ten_' . $lang] ?>">
                        </div>
                        <h1><?= $item['ten_' . $lang] ?></h1>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section> -->

<section id="scroll<?= $chungnhan__title["id"] ?>" class="chungnhan">
    <div class="container__item__bs">
        <h2 class="title__home"><?= $chungnhan__title['title_' . $lang] ?></h2>
        <h5 class="text-center"><?= $chungnhan__title['mo_ta_' . $lang] ?></h5>
        <div class="chungnhan__group owl-carousel">
            <?php foreach ($chungnhan__list as $key => $item) { ?>
                <div class="chungnhan__item">
                    <div class="chungnhan__img">
                        <img src="<?= URLPATH . 'img_data/images/' . $item['hinh_anh'] ?>" alt="<?= $item['ten_' . $lang] ?>">
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<section class="quytrinhthicong" id="scroll<?= $quytrinhthicong__title["id"] ?>">
    <div class="container__item__bs">
        <h2 class="title__home"><?= $quytrinhthicong__title['title_' . $lang] ?></h2>
        <div class="quytrinh__group">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="quytrinh__trai">
                        <div class="embed-responsive embed-responsive-4by3">
                            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?= $quytrinhthicong__title['video'] ?>" frameborder="0" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="quytrinh__phai">
                        <?php foreach ($quytrinhthicong__list as $key => $item) { ?>
                            <div class="quytrinh__item">
                                <div class="quytrinh__item__img">
                                    <img src="<?= URLPATH . 'img_data/images/' . $item['hinh_anh'] ?>" alt="<?= $item['title_' . $lang] ?>">
                                </div>
                                <div class="quytrinh__nhom">
                                    <h3><?= $item['title_' . $lang] ?></h3>
                                    <div><?= $item['noi_dung_' . $lang] ?></div>
                                </div>

                            </div>
                        <?php } ?>
                    </div>
                </div>


            </div>


        </div>
    </div>
</section>

<section id="scroll<?= $why__title["id"] ?>" class="why">
    <div class="container__item__bs">
        <h2 class="title__home"><?= $why__title['title_' . $lang] ?></h2>
        <div class="row">
            <?php foreach ($why__list as $key => $item) { ?>
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="why__item index<?= $key ?>">
                        <div class="why__img">
                            <img src="<?= URLPATH . 'img_data/images/' . $item['hinh_anh'] ?>" alt="<?= $item['ten_' . $lang] ?>">
                        </div>
                        <div class="cotenat">
                            <h1><?= $item['ten_' . $lang] ?></h1>
                            <p><?= $item['mo_ta_' . $lang] ?></p>
                        </div>

                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<section class="kinhnghiemth">
    <div class="container__item__bs">

        <div class="row">
            <?php foreach ($ex__list as $key => $item) {
                $string = explode("+", $item['ten_' . $lang]);
                if (count($string) > 1) {
            ?>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="kinhnghiemth__item">

                            <h1>+<span class="counter"><?= $string[1] ?></span></h1>
                            <h5><?= $item['mo_ta_' . $lang] ?></h5>
                        </div>
                    </div>
            <?php }
            } ?>
        </div>
    </div>
</section>

<section id="scroll<?= $proja__title["id"] ?>" class="chungnhan">
    <div class="container__item__bs">
        <h2 class="title__home"><?= $proja__title['title_' . $lang] ?></h2>
        <div class="pogroup__group owl-carousel">
            <?php foreach ($projalist__nb as $key => $item) { ?>
                <div class="projectitem__item">
                    <div class="projectitem__item__img">
                        <img src="<?= URLPATH . 'img_data/images/' . $item['picture'] ?>" alt="<?= $item['title_' . $lang] ?>">
                    </div>
                    <h3><?= $item['title_' . $lang] ?></h3>
                </div>
            <?php } ?>
        </div>
    </div>
</section>


<section id="scroll<?= $hinhanhxd__title["id"] ?>" class="hinhanhxaydung">
    <div class="container__item__bs">
        <h2 class="title__home"><?= $hinhanhxd__title['title_' . $lang] ?></h2>
        <div class="hinhanhxd__group owl-carousel">
            <?php foreach ($hinhnhxd__nb as $key => $item) { ?>
                <div class="hinhanh__item__item">
                    <div class="hinhanh__item__img">
                        <img src="<?= URLPATH . 'img_data/images/' . $item['picture'] ?>" alt="<?= $item['title_' . $lang] ?>">
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>


<section id="scroll<?= $khachhang__title["id"] ?>" class="khachhang">
    <div class="container__item__bs">
        <h2 class="title__home"><?= $khachhang__title['title_' . $lang] ?></h2>
        <div class="khachhang__group owl-carousel">
            <?php foreach ($khachhang__list as $key => $item) { ?>
                <div class="khachhang__item">
                    <div class="des__kh">
                        <?= $item['mo_ta_' . $lang] ?>
                    </div>
                    <div class="groupall">
                        <div class="kh__item__img">
                            <img src="<?= URLPATH . 'img_data/images/' . $item['hinh_anh'] ?>" alt="<?= $item['ten_' . $lang] ?>">
                        </div>
                        <h3><?= $item['title_' . $lang] ?></h3>
                    </div>

                </div>
            <?php } ?>
        </div>
    </div>
</section>

<section id="scroll<?= $tuvan__title["id"] ?>" class="tuvan">
    <div class="container__item__bs">
        <h2 class="title__home"><?= $tuvan__title['title_' . $lang] ?></h2>
        <div><?= $tuvan__title['mo_ta_' . $lang] ?></div>

        <div class="col-12">
            <h4 class="title-f"><?= _contac_us ?></h4>
            <form action="" id="frm_send">
                <input type="text" placeholder="<?= _hoten ?> *" id="ft_name_ip">
                <input type="text" placeholder="<?= _dienthoai ?> *" id="ft_phone_ip">
                <input type="text" placeholder="<?= _email ?> *" id="ft_email_ip">
                <textarea placeholder="<?= _content ?>" name="" id="ft_ms_ip" cols="30" rows="10"></textarea>
                <button type="button"><?= _send ?></button>
            </form>
        </div>
    </div>
</section>

<script>
    const listImage = [];

    const handleSelectItem = (e) => {
        e.classList.toggle("active");
        const src = e.getAttribute("data-src");
        const id = e.getAttribute("data-id");
        const index = listImage.findIndex(item => item.id === id);
        if (index === -1) {
            listImage.push({
                id,
                src
            })
        } else {
            listImage.splice(index, 1);
        }

        let listActiveItem = document.querySelectorAll(".thuctrang li.active");
        let buttonCompare = document.querySelector(".compare");
        if (listActiveItem.length > 0) {
            buttonCompare.classList.add("active");
        } else {
            buttonCompare.classList.remove("active");
        }
    }

    const handleClickShowView = (e) => {

        let listActiveItem = document.querySelectorAll(".thuctrang li.active");
        if (listActiveItem.length <= 0) {
            swal("<?= _chonmotvande ?>", "", "warning");
            return;
        }
        document.querySelector("body").classList.add("no-scroll");
        let data = "";
        let width = "";
        const size = listImage.length;
        for (let i = 0; i < listImage.length; i++) {
            if (size == 1) {
                width = "full";
            } else if (size == 2) {
                width = "full-50";
            } else if (size == 3) {
                width = " full-33";
            } else if (size == 4) {
                width = " full-50-2"
            } else {
                width = "";
            }

            data += `
                <div class="view__compare__item ${width}">
                    <img src="${listImage[i].src}" alt="pic">
                </div>
            `;
        }

        document.querySelector(".view__compare").classList.add("active");
        document.querySelector(".view__container").innerHTML = data;
    }

    const handleCloseShowView = (e) => {
        document.querySelector("body").classList.remove("no-scroll");
        e.classList.remove("active");
    }
</script>