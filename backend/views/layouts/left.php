<?php
use common\models\ModuleProfile;
use yii\helpers\Url;

$admin = true;
$guru = true;
$siswa = true;
$admin = (Yii::$app->user->identity->role == 10);
$guru = (Yii::$app->user->identity->role == 20);
$siswa = (Yii::$app->user->identity->role == 30);

$user = ModuleProfile::find()->where('user_id = '.Yii::$app->user->id)->one();

?>

<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php
                if(isset($user->avatar)&& ($user->avatar != "")){
                    if(file_exists(Yii::$app->basePath."/web/uploaded/img-profil/".$user->avatar)){
                        echo Url::base()."/uploaded/img-profil/".$user->avatar;
                    } else {
                        echo $directoryAsset.'/img/user2-160x160.jpg';
                    }
                } else {
                    echo $directoryAsset.'/img/user2-160x160.jpg';
                }
                ?>" class="img-circle" alt="User Image" style="width: 30px;height: 30px"/>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->username ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
         <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Side Menu', 'options' => ['class' => 'header']],
                    ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
                    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                    [
                        'label' => 'Admin fitur', 
                        'icon'=>'dashboard', 
                        'url'=>'#',
                        'visible' => $admin,
                        'items' => [
                            [
                                'label' => 'berita',
                                 'icon' => 'dashboard',
                                 'url' => '#',
                                 'items' => [
                                    ['label' => 'Berita', 'url' => ['/berita'], 'icon' => 'dashboard'],
                                    ['label' => 'Berita-kategori', 'url' => ['/berita-kategori'], 'icon' => 'dashboard'],
                                 ],
                             ],
                            ['label' => 'User Manage', 'url' => ['/user-manage'], 'icon' => 'dashboard'],
                            ['label' => 'Kelas', 'url' => ['/kelas'], 'icon' => 'dashboard'],
                            ['label' => 'Bank', 'url' => ['/bank'], 'icon' => 'dashboard'],
                            ['label' => 'Siswa', 'url' => ['/siswa'], 'icon' => 'dashboard'],
                            ['label' => 'Profile Manage', 'url' => ['/profile/all'], 'icon' => 'dashboard'],
                            [
                                'label' => 'Galeri', 
                                'url' => '#', 
                                'icon' => 'dashboard',
                                'items' => [
                                    ['label' => 'Galeri', 'icon'=> 'dashboard', 'url' => ['/galeri']],
                                    ['label' => 'Galeri Kategori', 'icon' => 'dashboard', 'url'=> ['/galeri-kategori']],
                                ],
                            ],
                        ]
                    ],
                    ['label' => 'Guru', 'url' => ['/guru'], 'icon' => 'dashboard'],
                    [
                        'label' => 'Jurusan',
                        'url' => ['/jurusan'],
                        'icon' => 'dashboard',
                    ],
                    ['label' => 'Mata Pelajaran', 'icon'=> 'dashboard','url'=>['/mata-pelajaran']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'label' => 'Some tools',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                            [
                                'label' => 'Level One',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
