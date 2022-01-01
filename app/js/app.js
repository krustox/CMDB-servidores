$(document).foundation()

$(window).on('load',function(){

  if($("#aplicativo").length > 0){

    len = $("body table").length
    i=0
    for (i = 0; i < len; i++) {
      name = $( "#subaplicaciones"+i ).attr('name');
      id= name.split(',')[0];
      ra= name.split(',')[1];
      LlenarTabla(id,i,ra);
    }

  }else if($("#servidoresk").length > 0){
      LlenarTablaServidoresk(GetURLParameter("id"),'');
      LlenarTablaServidoresm(GetURLParameter("id"),'');
  }else if($("#resultado-servidor").length > 0){
    if(GetURLParameter("server") == "kenos" ){
      LlenarTablaServidoresk('',GetURLParameter("id"));
    }else{
      LlenarTablaServidoresm('',GetURLParameter("id"));
    }
  }

});

function GetURLParameter(sParam){
    var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++)
    {
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParam)
        {
            return sParameterName[1];
        }
    }
}

function LlenarTabla(id,len,ra){
  $.getJSON( "../api/subaplicativos.php?id="+id+"&ra="+ra, function( data ) {
    $.each( data, function( key, val ) {
      if(val["RA_FIN"] == 1){
        fin = "SI";
        $( "#subaplicaciones"+len ).append( "<tr><td>"+val["ID"]+"</td><td>"+val["NOMBRE"]+"</td><td>"+val["AFA"]+"</td><td>"+val["RA"]+"</td> <td>"+fin+"</td><td></td></tr>" );
      }else{
        fin="NO";
        $( "#subaplicaciones"+len ).append( "<tr><td>"+val["ID"]+"</td><td>"+val["NOMBRE"]+"</td><td>"+val["AFA"]+"</td><td>"+val["RA"]+"</td> <td>"+fin+"</td><td><a href=\"subaplicativos.php?id="+val["ID"]+"\">Ver Subaplicativo</a><br /><a onclick=\"Fin('"+val["ID"]+"','"+id+"')\"> Finalizado </a></td></tr>" );
      }

    });
  });
}

function LlenarTablaServidoresk(id_subaplicativo,id){
  if(id_subaplicativo == ''){
    $.getJSON( "../api/servidores.php?id_subaplicativo="+id+"&server=kenos", function( data ) {
      $( "#resultado-servidor" ).empty();
      $( "#resultado-servidor" ).append("<thead><tr><th>ID</th><th>Nombre</th><th>Sistema Operativo</th><th>IP</th><th>Base de Datos</th><th>Granja</th><th>Acción</th></tr></thead><tbody>");
      $.each(data, function( key, val ) {
        $( "#resultado-servidor" ).append("<tr><td>"+ val["ID"]+" </td><td>"+val["NOMBRE"]+ "</td> <td>" +val["SO"] +"</td><td>" +val["IP"] +"</td><td>" +val["BASEDATOS"] +"</td><td>" +val["GRANJA"] +"</td><td> <a onclick=\"agregar_servidor('"+val["ID"]+"','"+id+"')\">Agregar</a> </td> </tr>");
      });
    });
  }else{
    $.getJSON( "../api/servidores.php?id="+id_subaplicativo+"&server=kenos", function( data ) {
      $( "#servidork" ).empty();
      $( "#servidork" ).append("<thead><tr><th>ID</th><th>Nombre</th><th>Sistema Operativo</th><th>IP</th><th>Base de Datos</th><th>Granja</th><th>Acción</th></tr></thead><tbody>");
      $.each(data, function( key, val ) {
        $( "#servidork" ).append( "<tr><td>"+ val["ID"]+" </td><td>"+val["NOMBRE"]+ "</td> <td>" +val["SO"] +"</td><td>" +val["IP"] +"</td><td>" +val["BASEDATOS"] +"</td><td>" +val["GRANJA"] +"</td><td> <a onclick=\"eliminar_servidor('"+val["ID"]+"','"+id_subaplicativo+"')\">Eliminar</a> </td> </tr>");
      });
    });
  }
}

function LlenarTablaServidoresm(id_subaplicativo,id){
  if(id_subaplicativo == ''){
    $.getJSON( "../api/servidores.php?id_subaplicativo="+id+"&server=morande", function( data ) {
      $( "#resultado-servidor" ).empty();
      $( "#resultado-servidor" ).append("<thead><tr><th>ID</th><th>Nombre</th><th>Sistema Operativo</th><th>IP</th><th>Base de Datos</th><th>Granja</th><th>Acción</th></tr></thead><tbody>");
      $.each(data, function( key, val ) {
        $( "#resultado-servidor" ).append("<tr><td>"+ val["ID"]+" </td><td>"+val["NOMBRE"]+ "</td> <td>" +val["SO"] +"</td><td>" +val["IP"] +"</td><td>" +val["BASEDATOS"] +"</td><td>" +val["GRANJA"] +"</td><td> <a onclick=\"agregar_servidor('"+val["ID"]+"','"+id+"')\">Agregar</a> </td> </tr>");
      });
    });
  }else{
    $.getJSON( "../api/servidores.php?id="+id_subaplicativo+"&server=morande", function( data ) {
      $( "#servidorm" ).empty();
      $( "#servidorm" ).append("<thead><tr><th>ID</th><th>Nombre</th><th>Sistema Operativo</th><th>IP</th><th>Base de Datos</th><th>Granja</th><th>Acción</th></tr></thead><tbody>");
      $.each(data, function( key, val ) {
        $( "#servidorm" ).append( "<tr><td>"+ val["ID"]+" </td><td>"+val["NOMBRE"]+ "</td> <td>" +val["SO"] +"</td><td>" +val["IP"] +"</td><td>" +val["BASEDATOS"] +"</td><td>" +val["GRANJA"] +"</td><td> <a onclick=\"eliminar_servidor('"+val["ID"]+"','"+id_subaplicativo+"')\">Eliminar</a> </td> </tr>");
      });
    });
  }
}

function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("resultado-servidor");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    td2 = tr[i].getElementsByTagName("td")[2];
    td3 = tr[i].getElementsByTagName("td")[3];
    td4 = tr[i].getElementsByTagName("td")[4];
    td5 = tr[i].getElementsByTagName("td")[5];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1
    || td2.innerHTML.toUpperCase().indexOf(filter) > -1
    || td3.innerHTML.toUpperCase().indexOf(filter) > -1
    || td4.innerHTML.toUpperCase().indexOf(filter) > -1
    || td5.innerHTML.toUpperCase().indexOf(filter) > -1  ) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function agregar_servidor(id,subap){

  swal({
  title: "Desea Agregar el servidor con id: "+id+" al subaplicativo con id: "+subap+"?",
  text: "",
  icon: "warning",
  buttons: true,
  dangerMode: true,
  })
  .then(function(willAdd)  {
  if (willAdd) {
    $.ajax({ type: "GET",
       url: "../api/servidor_agregar.php?id_servidor=" + id +"&id_subaplicativo="+ subap,
       async: false,
     datatype: "html",
       success : function(data)
       {
          swal(data, {
            icon: "success",
          }).then(function(data) {
            window.location = window.location.href;
          });
        }
        });
  }/* else {
    swal("Your imaginary file is safe!");
  }*/
  });
  /*
	if (confirm("Desea agregar el registro?")) {
        // your deletion code
	var response;
	$.ajax({ type: "GET",
     url: "../api/servicio_agregar.php?id_servicio=" + id +"&id_subaplicativo="+ subap,
     async: false,
	 datatype: "html",
     success : function(data)
     {
		       window.location = window.location.href;
		       window.alert(data);
           response= data;
     }
	});
  }
    return false;*/
}


function eliminar_servidor(id,subap){

  swal({
  title: "Desea eliminar el servidor con id: "+id+" del subaplicativo con id: "+subap+"?",
  text: "",
  icon: "warning",
  buttons: true,
  dangerMode: true,
  })
  .then(function(willDelete)  {
  if (willDelete) {
    $.ajax({ type: "GET",
       url: "../api/servidor_eliminar.php?id_servidor=" + id +"&id_subaplicativo="+ subap,
       async: false,
     datatype: "html",
       success : function(data)
       {
          swal(data, {
            icon: "success",
          }).then(function(data) {
            window.location = window.location.href;
          });
        }
        });
  }/* else {
    swal("Your imaginary file is safe!");
  }*/
  });
  /*	if (confirm("Desea eliminar el registro?")) {
        // your deletion code
	var response;
	$.ajax({ type: "GET",
     url: "../api/servicio_eliminar.php?id_servicio=" + id +"&id_subaplicativo="+ subap,
     async: false,
	 datatype: "html",
     success : function(data)
     {
		       window.location = window.location.href;
		       window.alert(data);
           response= data;
     }
	});
  }
    return false;*/
}

function Fin(id_sub,id_app){

  swal({
  title: "Desea marcar como Finalizado el subaplicativo con id: "+id_sub+"?",
  text: "",
  icon: "warning",
  buttons: true,
  dangerMode: true,
  })
  .then(function(willDelete) {
  if (willDelete) {
    $.ajax({ type: "GET",
       url: "../api/finalizado.php?id_sub=" + id_sub +"&id_app="+ id_app,
       async: false,
  	 datatype: "html",
       success : function(data)
       {
          swal(data, {
            icon: "success",
          }).then(function(data){
            window.location = window.location.href;
          });
        }
        });
  }
  });
}
