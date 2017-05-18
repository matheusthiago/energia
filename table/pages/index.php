<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Gerenciamento de Usuários</title>
        <script src="../vendor/jquery/jquery.min.js"></script> 
        <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- MetisMenu CSS 
        <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">-->
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/metisMenu/2.7.0/metisMenu.min.css">
        <!-- Custom CSS -->
        <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
        <!-- Custom Fonts -->
        <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


        <!-- ***************Scripts para o site ***************-->
        <!-- Bootstrap Core JavaScript -->
        <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
        <!-- Metis Menu Plugin JavaScript
        <script src="../vendor/metisMenu/metisMenu.min.js"></script> -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/metisMenu/2.7.0/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="../dist/js/sb-admin-2.js"></script>
        <!-- ****************************************************-->

        <!-- ********************SCRIPTS DATATABLE********************************-->

        <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css" />
        <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
        <script src="../vendor/datatables/js/dataTables.bootstrap.min.js"></script>		
        <link rel="stylesheet" href="../vendor/datatables/css/dataTables.bootstrap.min.css" />
        <!-- *********************************************************************

        <style>
            .box
            {
                padding:20px;
                background-color:#fff;
                border:1px solid #ccc;
                border-radius:5px;
                margin-top:25px;
            }
        </style>-->
    </head>
    <body>
        <div id="wrapper">
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html"><img src="../logo.png" alt=""/>
                    </a>
                </div>
                <!-- /.navbar-header -->

                <ul class="nav navbar-top-links navbar-right">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                            </li>
                            <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                            </li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <!-- /.dropdown -->
                </ul>
                <!-- /.navbar-top-links -->

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <li class="sidebar-search">
                                <div class="input-group custom-search-form">

                                </div>
                                <!-- /input-group -->
                            </li>
                            <li>
                                <a href="index.html"><i class="fa fa-dashboard fa-fw"></i> Home </a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-bolt fa-fw"></i>Consumo <span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="consumo_potencia.html"> Consumo em Potência (W)</a>
                                    </li>
                                    <li>
                                        <a href="consumo_corrente.html"> Consumo em Corrente (A)</a>

                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Relatórios <span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="relatorio_dia.html">Diario</a>
                                    </li>
                                    <li>
                                        <a href="relatorio_mes.html">Mensal</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            <li>
                                <a href="controle.html"><i class="glyphicon glyphicon-lamp"></i>  Controle </a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>
                <!-- /.navbar-static-side -->
            </nav>

            <!-- ***************Area da página*********************** -->
            <div id="page-wrapper">
                <div class="row">
                    <br>
                    <div class="col-lg-66">
                        <div class="panel panel-default">
                            <!-- *************** Subtititulo *********************** -->
                            <div class="panel-heading">
                                <i class="fa fa-bar-chart-o fa-fw"> </i> Gerenciar Usuários
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table id="user_data" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th width="25%">Nome</th>
                                                <th width="25%">Email</th>
                                                <th width="10%">Nivel</th>							
                                                <th width="10%">Senha</th>
                                                <th width="15%">Operações</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div align="left">
                                    <button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-info btn-lg">Adicionar</button>
                                </div>
                                <!--./tableresponsive-->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->

                    </div>
                    <!-- /.col-lg-66 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /#page-wrapper -->
        </div>
        <!-- /#wrapper -->
    </body>
</html>

<div id="userModal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="user_form" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add User</h4>
                </div>
                <div class="modal-body">
                    <label>Nome</label>
                    <input type="text" name="nome" id="nome" class="form-control" />
                    <br/>
                    <label>Email</label>
                    <input type="email" name="email" id="email" class="form-control" />
                    <br/>
                    <label>Nivel</label>
                    <input type="number" name="nivel" id="nivel" class="form-control" />
                    <br/>
                    <label>Senha</label>
                    <input type="text" name="senha" id="senha" class="form-control" />
                    <br/>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="user_id" id="user_id" />
                    <input type="hidden" name="operation" id="operation" />
                    <input type="submit" name="action" id="action" class="btn btn-success" value="Add"/>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript" language="javascript" >
    $(document).ready(function () {
        $('#add_button').click(function () {
            $('#user_form')[0].reset();
            $('.modal-title').text("Add User");
            $('#action').val("Add");
            $('#operation').val("Add");
        });

        var dataTable = $('#user_data').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                url: "fetch.php",
                type: "POST"
            },
            "columnDefs": [
                {
                    "targets": [0, 3, 4],
                    "orderable": false,
                },
            ],

        });

        $(document).on('submit', '#user_form', function (event) {
            event.preventDefault();
            var nome = $('#nome').val();
            var email = $('#email').val();
            var nivel = $('#nivel').val();
            var senha = $('#senha').val();

            if (nome !== '' && email !== '' && nivel !== '' && senha !== '')
            {
                $.ajax({
                    url: "insert.php",
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function (data)
                    {
                        alert(data);
                        $('#user_form')[0].reset();
                        $('#userModal').modal('hide');
                        dataTable.ajax.reload();
                    }
                });
            } else
            {
                alert("Both Fields are Required");
            }
        });

        $(document).on('click', '.update', function () {
            var user_id = $(this).attr("id");
            $.ajax({
                url: "fetch_single.php",
                method: "POST",
                data: {user_id: user_id},
                dataType: "json",
                success: function (data)
                {
                    $('#userModal').modal('show');
                    $('#nome').val(data.nome);
                    $('#email').val(data.email);
                    $('#nivel').val(data.nivel);
                    $('#senha').val(data.senha);
                    $('.modal-title').text("Edit User");
                    $('#user_id').val(user_id);
                    $('#action').val("Edit");
                    $('#operation').val("Edit");
                }
            })
        });

        $(document).on('click', '.delete', function () {
            var user_id = $(this).attr("id");
            if (confirm("Are you sure you want to delete this?"))
            {
                $.ajax({
                    url: "delete.php",
                    method: "POST",
                    data: {user_id: user_id},
                    success: function (data)
                    {
                        alert(data);
                        dataTable.ajax.reload();
                    }
                });
            } else
            {
                return false;
            }
        });


    });
</script>