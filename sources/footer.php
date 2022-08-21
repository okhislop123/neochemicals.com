<?php
$textfooter = $d->getTemplates(28);

$boccongthuong = $d->getTemplates(47);
$pay = $d->getTemplates(59);
$camket = $d->getImg(1262);

$nav_f2   = $d->o_fet("select * from #_category where id_loai = 1202 and hien_thi=1 order by so_thu_tu asc, id desc limit 0,4");


$quydinh   = $d->o_fet("select * from #_category where id=1223 and hien_thi=1 order by so_thu_tu asc, id desc limit 0,1");
$chamsoc   = $d->o_fet("select * from #_category where id=1278 and hien_thi=1 order by so_thu_tu asc, id desc limit 0,1");
$aboutus   = $d->o_fet("select * from #_category where id=1202 and hien_thi=1 order by so_thu_tu asc, id desc limit 0,1");
$listquydinh = $d->o_fet("select * from #_category where id_loai=1266 and hien_thi=1 order by so_thu_tu asc, id desc limit 0,5");
$listchamsoc = $d->o_fet("select * from #_category where id_loai=1278 and hien_thi=1 order by so_thu_tu asc, id desc limit 0,5");
$thongtinft = $d->simple_fetch("select * from #_thongtin limit 0,1");
$hotro = $d->simple_fetch("select * from #_hotro limit 0,1");
$category_ft = $d->simple_fetch("select * from #_category where id = 1305");
$project__list = $d->o_fet("select * from #_tintuc where id_loai = 1305 and noi_bat = 1 order by so_thu_tu asc, id desc limit 0,10");

?>
<footer class="<?= $com = '' ? 'home' : 'nothome' ?>">

    <div class="container__item__bs">
        <div class="row">


            <div class="col-md-4 col-sm-6">
                <h4 class="title-f"><?= $textfooter['ten_' . $lang] ?></h4>
                <div class="mo-ta-ft">
                    <?= $textfooter['noi_dung_' . $lang] ?>
                </div>
            </div>

            <div class="col-md-4 col-sm-6">
                <h4 class="title-f"><?= _bando ?></h4>
                <div class="mo-ta-ft">
                    <?= $thongtinft['map'] ?>
                </div>
            </div>

            <div class="col-md-4 col-sm-6">
                <h4 class="title-f"><?= _facebook ?></h4>
                <div class="mo-ta-ft">
                    <div class="fb-page" data-href="<?= $thongtinft['facebook'] ?>" data-tabs="timeline" data-width="" data-height="200" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="true">

                    </div>
                </div>
            </div>

        </div>
    </div>



</footer>

<div class="chantr">
    <div class="chantrang_container">
        <div class="chantrang-trai">
            <?= $copyright ?>
        </div>
    </div>
</div>

<?php include 'module/call_to_action.php'; ?>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v14.0&appId=581126359432126&autoLogAppEvents=1" nonce="w1lcP6Ip"></script>
<?php if ($lang == 'vn') { ?>
    <script>
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.8";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
<?php } else { ?>
    <script>
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/us_US/sdk.js#xfbml=1&version=v2.8";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
<?php } ?>

<script language="javascript">
    function register_email() {
        if ($('#email_dk').val() == "" && $('#sdt_dk').val() == '') {
            alert('Vui lòng nhập email ');
        } else {
            $.ajax({
                url: "sources/ajax-search.php",
                type: "post",
                dataType: "text",
                data: {
                    do: 'register_email',
                    email: $('#email_dk').val(),
                    email2: $('#sdt_dk').val()
                },
                success: function(result) {
                    if (result == "ok") {
                        $('#email_dk').val('');

                        alert('Đăng ký thành công');
                    } else {
                        alert('Đăng ký không thành công' + result);
                    }
                }
            });
        }

    }
</script>