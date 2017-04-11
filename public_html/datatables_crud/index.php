<!DOCTYPE html>
<html>
    <head>
        <title>Gerenciamento de usuários</title>
        <link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
        <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    </head>
    <body>

        <div class="container">

            <div class="row">>DataTables</small> </h1> </center>
                <div class="col-md-12">
                    <center> <h1 class="page-header"> teste <small> teste datatabeles </small> </h1> </center>
                    <div class="removeMeessages"> 
                    </div>
                    <button class="btn btn-default pull pull-right" data-toggle="modal" data-target="#addMember" id="addMemberModalBtn">
                        <span class="glyphicon glyphicon-plus-sign"> Adicionar usuário</span>
                    </button>
                    <br /> <br /> <br />
                    <table class="table" id="manageMemberTable">                  
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>username</th>                                                   
                                <th>email</th>
                                <th>password</th>                                
                                <th>salt</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <!-- add modal-->
        <div clas="modal fade" tabindex="-1" role="dialog" id="addMember">
            <div class="modal-dialog" role="document">
                <div modal-content>
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><span class="glyphicon glyphicon-plus-sign"></span>  Add Member</h4>
                    </div>
                </div>
                <form class="form-horizontal" action="php_action/create.php" method="POST" id="createMemberForm">
                    <div class="modal-body">
                        <div class="messages"></div>
                        <div class="form-group"> 
                            <label for="username" class="col-sm-2" control-label> username</label>
                            <div class="col-sm-10"
                                 <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-2" control-label> Email</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-2" control-label> password</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="password" name="password" placeholder="password">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"> Close</button>
                        <button type="submit" class="btn btn-primary"> Salvar </button> 
                    </div>
                </form>
            </div>
        </div>
        <script type="text/javascript" src="/vendor/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="/vendor/bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/vendor/datatables/js/dataTables.material.min.js"</script>
        <script type="text/javascript" src="custom/js/index.js"></script>



    </body>
</html>


