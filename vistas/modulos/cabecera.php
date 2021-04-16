<!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="index.html"><img src="vistas/assets/images/logo-header.svg" class="mr-2" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="index.html"><img src="vistas/assets/images/logo-header-mini.svg" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="ti-view-list"></span>
        </button>
         <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-search d-none d-lg-block">
            <button type="button" class="btn btn-primary btn-icon-text btn-rounded" data-toggle='modal' data-target='#modalRegistrarCompra'>
            <i class="ti-clipboard btn-icon-prepend"></i>Registrar Mi Compra
            </button>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">

          <li class="nav-item nav-profile dropdown">
            

            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="vistas/assets/images/logo-header-mini.png" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
            
              <a class="dropdown-item" href="salir">
                <i class="ti-power-off text-primary"></i>
                Salir
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="ti-view-list"></span>
        </button>
      </div>
    </nav>

<!-- Modal Acceder-->
<div class="modal fade" id="modalRegistrarCompra" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" id="modalEstilo">
        <h5 class="modal-title" id="exampleModalLabel">Registrar Mi Compra</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <section class="contact-area ">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="contact-form">
                        <form id="formRegisterSale" novalidate>
                            <div class="row">
                               
                                 <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="single-form form-group">
                                      <p>Serie Compra</p>
                                      <select name="serieCompra" id="serieCompra" class="form-control" style="margin-top: 6px;height: 60px">
                                        <option value="FACP">FACP</option>
                                        <option value="FASM">FASM</option>
                                        <option value="FATR">FATR</option>
                                        <option value="FARF">FARF</option>
                                        <option value="FASG">FASG</option>
                                     
                                      </select>
                                   
                                        
                                    </div> <!-- single form -->
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="single-form form-group">
                                        <p>Folio Compra</p>
                                        <input type="text" class="form-control" name="folioCompra" id="folioCompra" placeholder="Folio" required data-validation-required-message="Ingresa el folio de tu compra" maxlength="10" onkeyup="limpiarNumero(this)" onchange="limpiarNumero(this)">
                                        <i class="lni-tag"></i>
                                          <p class="help-block text-danger"></p>
                                        
                                    </div> <!-- single form -->
                                </div>

                                <div class="col-md-12">
                                    <div class="single-form form-group">
                                        <button type="submit" class="main-btn main-btn-2" id="btnRegister">Registrar</button>
                                    </div> <!-- single form -->
                                    <div id="successRegisterSale"></div>
                                    <center><div class="spinner" id="spinner"></div></center>
                                    <script>

                                           document.getElementById("spinner").style.display = "none";
                                       
                                    </script>
                                </div>
                            </div> <!-- row -->
                        </form>
                    </div> <!-- contact form -->
                </div>
                </div>
            </div>
            
        </section>
      </div>
      <div class="modal-footer">
        <button type="button" class="main-btn main-btn-2" data-dismiss="modal">Cerrar</button>
      
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  function limpiarNumero(obj) {
      /* El evento "change" sólo saltará si son diferentes */
      obj.value = obj.value.replace(/\D/g, '');
    }

   
</script>
<style type="text/css" media="screen">
  strong {
  display: block;
  font-size: 20px;
  color: #a52958;
  margin: 0 0 10px 0;
}
  
</style>