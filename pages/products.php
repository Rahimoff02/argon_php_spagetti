<?php include"top.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>My Storage | Products  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
</head>

<?php  include"header.php"; 

   echo' <div class="container-fluid py-4">';
   
   $tarix=date('Y-m-d H:i:s');
   
   if(!isset($_POST['edit']))
   {
       echo'
       <div class="alert alert-secondary" role="alert">
       <form method="post">
       Mehsul:<br>
       <input type="text" name="mehsul" class="form-control"><br>
       Brand:<br>
       <select name="brand_id" class="form-control">
       <option value="">Brend secin</option><br>';
   
       $bsec = mysqli_query($con,"SELECT * FROM users,brands WHERE users.id=brands.user_id AND user_id = '".$_SESSION['user_id']."' ORDER BY brands.brend ASC");
       while($binfo = mysqli_fetch_array($bsec))
           {echo'<option value="'.$binfo['id'].'">'.$binfo['brend'].'</option><br>';}
       
       echo'
       </select>
       <br>
       Alish:<br>
       <input type="text" name="alish" class="form-control"><br>
       Satish:<br>
       <input type="text" name="satish" class="form-control"><br>
       Miqdar:<br>
       <input type="text" name="miqdar" class="form-control"><br>
       <button type="submit" name="insert" class="btn btn-dark">Gir</button>
       </form>
       </div>';	
   }
   
   //-------------------------------------------------EDIT------------------------------------------------//
   
   if(isset($_POST['edit']))
   {
       $editing=mysqli_query($con,"SELECT * FROM products WHERE id='".$_POST['id']."' ");
       $info=mysqli_fetch_array($editing);
   
       echo'<div class="alert alert-secondary" role="alert">
       <form method="post">
       Mehsul:<br>
       <input type="text" name="mehsul" value="'.$info['mehsul'].'" class="form-control"><br>
   
       Brend:<br>
       <select name="brand_id" class="form-control"><br>
       <option value="">Brend secin</option>';
   
       $bsec=mysqli_query($con,"SELECT * FROM brands ORDER BY brend ASC ");
   
       while ($binfo=mysqli_fetch_array($bsec))
       {
           if($info['brand_id']==$binfo['id'])
               {echo'<option selected value="'.$binfo['id'].'">'.$binfo['brend'].'</option>';}
           else
               {echo'<option value="'.$binfo['id'].'">'.$binfo['brend'].'</option>';}
   
       }
       echo'
       </select>
       <br>
       Alish:<br>
       <input type="text" name="alish" value="'.$info['alish'].'" class="form-control"><br>
       Satish:<br>
       <input type="text" name="satish" value="'.$info['satish'].'" class="form-control"><br>
       Miqdar:<br>
       <input type="text" name="miqdar" value="'.$info['miqdar'].'" class="form-control"><br>
       <input type="hidden" name="id" value="'.$info['id'].'">
       <button type="submit" name="update" class="btn btn-success">Yenile</button>
   
   </form>
   </div>';
   }
   
   //------------------------------------------------UPDATE---------------------------------------------------//
   
   if(isset($_POST['update']))
   {
       $mehsul=mysqli_real_escape_string($con,htmlspecialchars(strip_tags(trim($_POST['mehsul']))));
       $brand_id=mysqli_real_escape_string($con,htmlspecialchars(strip_tags(trim($_POST['brand_id']))));
       $alish=mysqli_real_escape_string($con,htmlspecialchars(strip_tags(trim($_POST['alish']))));
       $satish=mysqli_real_escape_string($con,htmlspecialchars(strip_tags(trim($_POST['satish']))));
       $miqdar=mysqli_real_escape_string($con,htmlspecialchars(strip_tags(trim($_POST['miqdar']))));
   
       if(!empty($mehsul) && !empty($brand_id) && !empty($alish) && !empty($satish) && !empty($miqdar))
       {
           $updating=mysqli_query($con,"UPDATE products SET
                                  mehsul='".$mehsul."',
                                  brand_id='".$brand_id."',
                                  alish='".$alish."',
                                  satish='".$satish."',
                                  miqdar='".$miqdar."'
   
                                  WHERE id='".$_POST['id']."'");
   
           if($updating==true)
               {echo'<div class="alert alert-success" role="alert">Melumatlar ugurla yenilendi.</div>';}
           else
               {echo'<div class="alert alert-danger" role="alert">Melumatlari yenilemek mumkun olmadi.</div>';}
   }
   
   else
   {echo'<div class="alert alert-warning" role="alert">Bosh xanalari doldurun !</div>';}
   
   }
   
   //------------------------------------------DELETE----------------------------------------//
   
   if(isset($_POST['delete']))
   {
       echo'<div class="alert alert-warning" role="alert">Silmek isteyirsinizmi ?</div>
   
       <form method="post">
       <button type="submit" name="he" class="btn btn-success">He</button>
       <button type="submit" name="yox" class="btn btn-danger">Yox</button>
       <input type="hidden" name="id" value="'.$_POST['id'].'">
   
       </form>
       ';
   }
   
   if(isset($_POST['he']))
   {
       $deleting=mysqli_query($con,"DELETE FROM products WHERE id='".$_POST['id']."'");
   
       if($deleting==true)
       {echo'<div class="alert alert-success" role="alert">Melumatlar ugurla silindi.</div>';}
       else
       {echo'<div class="alert alert-danger" role="alert">Melumatlar silinmedi.</div>';}
   }
   
   //-----------------------------------------------INSERT--------------------------------------------//
   
   if(isset($_POST['insert']))
   {
   
       $mehsul=mysqli_real_escape_string($con,htmlspecialchars(strip_tags(trim($_POST['mehsul']))));
       $brand_id=mysqli_real_escape_string($con,htmlspecialchars(strip_tags(trim($_POST['brand_id']))));
       $alish=mysqli_real_escape_string($con,htmlspecialchars(strip_tags(trim($_POST['alish']))));
       $satish=mysqli_real_escape_string($con,htmlspecialchars(strip_tags(trim($_POST['satish']))));
       $miqdar=mysqli_real_escape_string($con,htmlspecialchars(strip_tags(trim($_POST['miqdar']))));
   
       if(!empty($mehsul) &&  !empty($brand_id) && !empty($alish) && !empty($satish) && !empty($miqdar))
       {
           $inserting=mysqli_query($con,"INSERT INTO products(mehsul,brand_id,alish,satish,miqdar,user_id,tarix) 
                                  VALUES('".$mehsul."','".$brand_id."','".$alish."','".$satish."','".$miqdar."','".$_SESSION['user_id']."','".$tarix."')");
   
   
           if($inserting==true)
           {echo'<div class="alert alert-success" role="alert">Melumatlar qeyde alindi.</div>';}
           else
           {echo'<div class="alert alert-danger" role="alert">Melumatlar qeyde alinmadi.</div>';}
   }
   
   else
   {echo'<div class="alert" alert-warning" role="alert">Bos xanalari doldurun !</div>';}
   
   }
   
   //----------------------------------------------SECIM DELETE------------------------------------------//
   
   if(isset($_POST['secsil']) && count($_POST['secim'])>0)
   {
       echo'Secilmisleri silmeye eminsiniz ?
       <form method="post">';
       for($n=0;$n<count($_POST['secim']); $n++)
           echo'<input type="hidden" name="secim[]" value="'.$_POST['secim'][$n].'">';
           echo'
       <button type="submit" name="beli" class="btn btn-success">Beli</button>
       <button type="submit" name="xeyr" class="btn btn-danger">Xeyr</button>    
   </form>';
   }
   
   if(isset($_POST['beli']) && count($_POST['secim'])>0)
   {
       for($n=0;$n<count($_POST['secim']); $n++)
       {
           $sil=mysqli_query($con,"DELETE FROM products WHERE id='".$_POST['secim'][$n]."'");
       }
       {echo'<div class="alert alert-danger" role="alert">Seçilmiş məlumatlar uğurla silindi.</div>';}
   }
   
   //--------------STATISTIKA
   include"static.php";
   //--
   
   //FILTERS START
   
   if(isset($_GET['f1'])=='ASC')
   {$order = 'ORDER BY mehsul ASC'; $f1 = '<a href="?f1=DESC"><i class="bi bi-sort-alpha-down-alt"></i></a>';}
   
   elseif(isset($_GET['f1'])=='DESC')
   {$order = 'ORDER BY mehsul DESC'; $f1 = '<a href="?f1=ASC"><i class="bi bi-sort-alpha-down"></i></a>';}
   
   else
   {$f1 = '<a href="?f1=ASC"><i class="bi bi-sort-alpha-down"></i></a>';}
   
   
   if(isset($_GET['f2'])=='ASC')
   {$order = 'ORDER BY tarix ASC'; $f2 = '<a href="?f1=DESC"><i class="bi bi-sort-alpha-down-alt"></i></a>';}
   
   elseif(isset($_GET['f2'])=='DESC')
   {$order = 'ORDER BY tarix DESC'; $f2 = '<a href="?f1=ASC"><i class="bi bi-sort-alpha-down"></i></a>';}
   
   else
   {$f2 = '<a href="?f2=ASC"><i class="bi bi-sort-alpha-down"></i></a>';}
   
   if(!isset($_GET['f1']) && !isset($_GET['f2']))
   {$order = 'ORDER BY id DESC';}
   
   //FILTER END
   
   //--------------------------------------------------SELECT-----------------------------------------------//
   
   if(isset($_POST['axtar']) && !empty($_POST['sorgu']))
   {
     $axtar = " AND (mehsul LIKE '%".$_POST['sorgu']."%' OR alish LIKE '%".$_POST['sorgu']."%' OR miqdar LIKE '%".$_POST['sorgu']."%')";
   }
   
   $selecting=mysqli_query($con,"SELECT 
       brands.brend,
       products.id, 
       products.mehsul,
       products.alish,
       products.satish,
       products.miqdar,
       products.tarix
       FROM users,brands, products
       WHERE
       brands.id=products.brand_id AND users.id=products.user_id AND users.id='".$_SESSION['user_id']."'
       ".$axtar.$order." ");
   
   $count=mysqli_num_rows($selecting);
   
   $i=0;
   
   if($count==0)
   {echo' ';}
   else
   {echo'<div class="alert alert-warning" role="alert">Anbarda <b>'.$count.'</b> brend var.</div>';}
   
   echo '<form method="post">';
   
   echo'<div class="table-dark">
       <table class="table table-hover table-dark">
          <thead class="thead-dark">
    
       
       <th>#</th>
       <th>Mehsul '.$f1.'</th>
       <th>Brand</th>
       <th>Alish</th>
       <th>Satish</th>
       <th>Miqdar</th>
       <th>Qazanc</th>
       <th>Tarix '.$f2.'</th>
       <th><button type="submit" name="secsil" class="btn btn-danger btn-sm">Secimleri sil</button></th>
       <th></th>
   
       </thead>
   
       <tbody> ';
   
   while($info=mysqli_fetch_array($selecting)) 
   {
       $i++;
   
       $qazanc=($info['satish']-$info['alish'])*$info['miqdar'];
   
   
       echo'<tr>';
       echo'<td>'.$i.' <input type="checkbox" name="secim[]" value="'.$info['id'].'"></td>';
       echo'<td>'.$info['mehsul'].'</td>';
       echo'<td>'.$info['brend'].'</td>';
       echo'<td>'.$info['alish'].'</td>';
       echo'<td>'.$info['satish'].'</td>';
       echo'<td>'.$info['miqdar'].'</td>';
       echo'<td>'.$qazanc.'</td>';
       echo'<td>'.$info['tarix'].'</td>';
   
       echo'
       <td>
       <form method="post">
   
       <input type="hidden" name="id" value="'.$info['id'].'">
       <button type="submit" name="edit" class="btn btn-success">Edit</button>
       <button type="submit" name="delete" class="btn btn-danger">Sil</button>
   
       </form>
       </td>';
   
       echo'</tr>';
   }
   
   echo'</tbody>
   </table>';
   
   echo'</div>';
   
   ?>
   
   

  </main>
  <div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
      <i class="fa fa-cog py-2"> </i>
    </a>
    <div class="card shadow-lg">
      <div class="card-header pb-0 pt-3 ">
        <div class="float-start">
          <h5 class="mt-3 mb-0">Argon Configurator</h5>
          <p>See our dashboard options.</p>
        </div>
        <div class="float-end mt-4">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="fa fa-close"></i>
          </button>
        </div>
        <!-- End Toggle Button -->
      </div>
      <hr class="horizontal dark my-1">
      <div class="card-body pt-sm-3 pt-0 overflow-auto">
        <!-- Sidebar Backgrounds -->
        <div>
          <h6 class="mb-0">Sidebar Colors</h6>
        </div>
        <a href="javascript:void(0)" class="switch-trigger background-color">
          <div class="badge-colors my-2 text-start">
            <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
          </div>
        </a>
        <!-- Sidenav Type -->
        <div class="mt-3">
          <h6 class="mb-0">Sidenav Type</h6>
          <p class="text-sm">Choose between 2 different sidenav types.</p>
        </div>
        <div class="d-flex">
          <button class="btn bg-gradient-primary w-100 px-3 mb-2 active me-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
          <button class="btn bg-gradient-primary w-100 px-3 mb-2" data-class="bg-default" onclick="sidebarType(this)">Dark</button>
        </div>
        <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
        <!-- Navbar Fixed -->
        <div class="d-flex my-3">
          <h6 class="mb-0">Navbar Fixed</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
          </div>
        </div>
        <hr class="horizontal dark my-sm-4">
        <div class="mt-2 mb-5 d-flex">
          <h6 class="mb-0">Light / Dark</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
          </div>
        </div>
        <a class="btn bg-gradient-dark w-100" href="https://www.creative-tim.com/product/argon-dashboard">Free Download</a>
        <a class="btn btn-outline-dark w-100" href="https://www.creative-tim.com/learning-lab/bootstrap/license/argon-dashboard">View documentation</a>
        <div class="w-100 text-center">
          <a class="github-button" href="https://github.com/creativetimofficial/argon-dashboard" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star creativetimofficial/argon-dashboard on GitHub">Star</a>
          <h6 class="mt-3">Thank you for sharing!</h6>
          <a href="https://twitter.com/intent/tweet?text=Check%20Argon%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fargon-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet
          </a>
          <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/argon-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share
          </a>
        </div>
      </div>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <script>
    var ctx1 = document.getElementById("chart-line").getContext("2d");

    var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
    gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
    new Chart(ctx1, {
      type: "line",
      data: {
        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
          label: "Mobile apps",
          tension: 0.4,
          borderWidth: 0,
          pointRadius: 0,
          borderColor: "#5e72e4",
          backgroundColor: gradientStroke1,
          borderWidth: 3,
          fill: true,
          data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
          maxBarThickness: 6

        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              padding: 10,
              color: '#fbfbfb',
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#ccc',
              padding: 20,
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
        },
      },
    });
  </script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/argon-dashboard.min.js?v=2.0.4"></script>
</body>

</html>