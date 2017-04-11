<!DOCTYPE html>
<html>
    <head>
        <title>CRUD SYSTEM</title>

        <!-- bootstrap css -->
        <link rel="stylesheet" type="text/css" href="assests/bootstrap/css/bootstrap.min.css">
        <!-- datatables css -->
        <link rel="stylesheet" type="text/css" href="assests/datatables/datatables.min.css">

    </head>
    <body>

        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <center><h1 class="page-header">CRUD System <small>DataTables</small> </h1> </center>

                    <div class="removeMessages"></div>

                    <button class="btn btn-default pull pull-right" data-toggle="modal" data-target="#addMember" id="addMemberModalBtn">
                        <span class="glyphicon glyphicon-plus-sign"></span> Add Member
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

        <!-- add modal -->
        <div class="modal fade" tabindex="-1" role="dialog" id="addMember">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><span class="glyphicon glyphicon-plus-sign"></span>  Add Member</h4>
                    </div>

                    <form class="form-horizontal" action="php_action/create.php" method="POST" id="createMemberForm">

                        <div class="modal-body">
                            <div class="messages"></div>
                            <div class="form-group">
                                <label for="username" class="col-sm-2" control-label> Username</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Insira um user name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-sm-2" control-label> Email</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="email" name="email" placeholder=" insira um Email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-sm-2" control-label> Senha</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="password" name="password" placeholder=" insira uma senha">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form> 
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!-- /add modal -->

        <!-- jquery plugin -->
        <script type="text/javascript" src="assests/jquery/jquery.min.js"></script>
        <!-- bootstrap js -->
        <script type="text/javascript" src="assests/bootstrap/js/bootstrap.min.js"></script>
        <!-- datatables js -->
        <script type="text/javascript" src="assests/datatables/datatables.min.js"></script>
        <!-- include custom index.js -->
        <script type="text/javascript" src="custom/js/index.js"></script>

    </body>
</html>