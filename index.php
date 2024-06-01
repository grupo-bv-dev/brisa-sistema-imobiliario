<?php 
  require_once ("conexao.php");
  $senha_crip=md5('123');
  //criar um usuário administrador caso não exista nenhum
  $query=$pdo->query("SELECT * FROM usuarios WHERE nivel='admin'");
  $res=$query->fetchAll(PDO::FETCH_ASSOC);
  $total_reg=@count($res);
  if($total_reg==0){
    $pdo->query("INSERT INTO usuarios SET nome='Administrador',cpf='000.000.000-00', email='calebemaia@gmail.com',senh_crip='$senha_crip',senha='123',nivel='admin'"); 
  }


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">" <!-- essa tag serve para responsividade do site -->

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $nome_site ?></title>
</head>
<body>
<section class="vh-100" style="background-color: #61eb34;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <img src="imagens/logo1.jpeg"  class="img-fluid" style="border-radius: 1rem 0 0 1rem;" /> <!-- aqui entra uma logo --> 
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

                <form action="autenticar.php" method="POST">

                  <div class="d-flex align-items-center mb-3 pb-1">
                    <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                    <span class="h1 fw-bold mb-0"><img src="imagens/logo1.jpg" width="30%" alt=""></span> <!-- aqui entra uma logo -->
                  </div>

                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">LOGAR COMO USUARIO</h5><!-- AQUI E PARTE DO TEXTO ABAIXO DA LOGO-->

                  <div class="form-outline mb-4">
                    <input type="text" id="usuario" class="form-control form-control-lg" name ="usuario"/>
                    <label class="form-label" for="form2Example17">Email ou cpf </label>
                  </div>

                  <div class="form-outline mb-4">
                    <input type="password" id="senha" class="form-control form-control-lg"name="senha" />
                    <label class="form-label" for="form2Example27"> <small>Senha</small></label>
                  </div>

                  <div class="pt-1 mb-4">
                    <button class="btn btn-dark btn-lg btn-block" type="submit">Login</button>
                  </div>

                  <a class="small text-muted" href="#"data-bs-toggle="modal" data-bs-target="#modalRecuperar"> Recuperar senha</a> <!--aqui entra a modal de recuperaçaõ de senha-->
                 
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

</body>
</html>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  Launch static backdrop modal
</button>

<!-- Modal -->
<div class="modal fade" id="modalRecuperar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Recuperar senha</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <!--a tag abaixo é a parte de recuperar senha-->
      <form id="form-recuperar" method="POST">
      <div class="modal-body">
      <input type="email" id="email" class="form-control form-control-sm" name ="email" required />
      </div>
      <div class="modal-footer">
  
        <button type="submit" class="btn btn-primary">Recuperar</button>
      </div>
      </form>
    </div>
  </div>
</div>