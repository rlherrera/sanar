{extends file='layout.tpl'}
{block name="title"}My Page Title{/block}
{block name="styles" append}
  <link rel="stylesheet" href="{$url}assets/plugins/data-tables/DT_bootstrap.css" />
  <link rel="stylesheet" type="text/css" href="{$url}assets/plugins/select2/select2_metro.css" />
{/block}
{block name="body"}{/block}
{block name="page-content"}
     <!-- BEGIN PAGE HEADER-->
     <div class="row">
        <div class="col-md-12">
           <!-- BEGIN PAGE TITLE & BREADCRUMB-->
           <h3 class="page-title">
              Administrar Usuarios
           </h3>
           <ul class="page-breadcrumb breadcrumb">
             <li>
                 <i class="icon-home"></i>
                 <a href="{$url}">Inicio</a> 
                 <i class="icon-angle-right"></i>
              </li>
              <li>
                 <a href="#">Usuarios</a>
              </li>
           </ul>
           <!-- END PAGE TITLE & BREADCRUMB-->
        </div>
     </div>
     <!-- END PAGE HEADER-->
     <!-- BEGIN PAGE CONTENT-->
     <div class="row">
        <div class="col-md-12">
               <!-- BEGIN EXAMPLE TABLE PORTLET-->
               <div class="portlet box grey">
                  <div class="portlet-title">
                     <div class="caption"><i class="icon-user"></i>Usuarios</div>
                     <div class="actions">
                        <a href="{$url}administrador/nuevo" class="btn green"><i class="icon-pencil"></i> Nuevo</a>
                     </div>
                  </div>
                  <div class="portlet-body">
                     <table class="table table-striped table-bordered table-hover" id="sample_2">
                        <thead>
                           <tr>
                              <th style="width1:8px;"><input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" /></th>
                              <th >Nombres</th>
                              <th >Apellidos</th>
                              <th >Usuario</th>
                              <th >Correo</th>
                              <th >Teléfono</th>
                              <th >Editar</th>
                              <th >Eliminar</th>
                           </tr>
                        </thead>
                        <tbody>
                            {foreach $_usuarios as $i}
                            	<tr class="odd gradeX">
                                  <td><input type="checkbox" class="checkboxes" value="1" /></td>
                                  <td>{$i.nombres}</td>
                                  <td>{$i.apellidos}</td>
                                  <td>{$i.usuario}</td>
                                  <td ><a href="mailto:{$i.email}">{$i.email}</a></td>
                                  <td>{$i.telefono}</td>
                                  <td><a href="{$url}administrador/nuevo/{$i.id}" class="btn default btn-xs purple"><i class="icon-edit"></i> Editar</a></td>
                                  <td><a href="#" class="btn default btn-xs black"><i class="icon-trash"></i> Eliminar</a></td>
                               </tr>
                            {/foreach}
                        </tbody>
                     </table>
                  </div>
               </div>
               <!-- END EXAMPLE TABLE PORTLET-->
            </div>
     </div>
     <!-- END PAGE CONTENT-->
{/block}
{block name="scripts" append}
<script type="text/javascript" src="{$url}assets/plugins/data-tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="{$url}assets/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="{$url}assets/plugins/data-tables/DT_bootstrap.js"></script>
<script src="{$url}assets/scripts/table-managed.js"></script>
<script>
  jQuery(document).ready(function() {       
	 App.init();
	 TableManaged.init();
  });
</script>

{/block}