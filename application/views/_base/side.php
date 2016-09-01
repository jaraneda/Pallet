<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
        <li class="active">
            <a href="#" data-toggle="collapse" data-target="#administracion"><i class="fa fa-fw fa-dashboard"></i> Administración <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="administracion" class="collapse">
                <li>
                    <a href="<?php echo site_url('admin/gestion_usuarios');?>"><i class="fa fa-fw fa-dashboard"></i> Usuarios</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Gestión de Contenido <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="demo" class="collapse">
                <li>
                    <a href="<?php echo site_url('creator/gestion_documentos');?>"><i class="fa fa-fw fa-file"></i> Documentos</a>
                </li>
            </ul>
        </li>
    </ul>
</div>
<!-- /.navbar-collapse -->