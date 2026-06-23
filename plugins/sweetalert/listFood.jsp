<%@page import="java.sql.ResultSet"%>
<%@page import="java.sql.PreparedStatement"%>
<%@page import="code.connect"%>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="js/jquery.dataTables.css">
<script>
$(document).ready(function() {
    var table = $('#example').DataTable();
} );
</script>
<style>
input,select{
  height: 34px;
  padding: 6px 12px;
  font-size: 14px;
  line-height: 1.42857143;
  color: #555;
  background-color: #fff;
  background-image: none;
  border: 1px solid #ccc;
  border-radius: 4px;
  -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
  box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
  -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
  -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
  transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
}
</style>
<h1>Food List</h1>
<div id="htSearch">
<table id="example" class="display" cellspacing="0" width="100%">
    <thead>
    <tr>
    <th>Food ID</th>
    <th>Food name</th>
    <th>Unit Price</th>
    <th>Type</th>
    <th>Image</th>
    <th>#</th>
    <th>#</th>
    <th>#</th>
</tr>
</thead>
<tbody>
<%
    connect con = new connect();
    PreparedStatement stm = con.connect().prepareStatement("select * from Food");
    ResultSet rs = stm.executeQuery();
    while (rs.next()) {
%>
<tr>
<td><% out.println(rs.getString("FoodID"));%></td>
<td><% out.println(rs.getString("FoodName"));%></td>
<td><% out.println(rs.getString("UnitPrice"));%></td>
<td><% if(rs.getString("Type").equals("1")){out.println("Vegetarian");}else{out.print("Tapas");}%></td>
<td><img src="<% out.println(rs.getString("Image"));%>" width="30" height="30"></td>
<td><a href="?t=editImageFood&id=<% out.println(rs.getString("FoodID"));%>"><span class="glyphicon glyphicon-picture"></span> Edit image</a></td>
<td><a href="?t=editFood&id=<% out.println(rs.getString("FoodID"));%>"><span class="glyphicon glyphicon-pencil"></span> Edit</a></td>
<td><a onclick="deleteData('<% out.print(rs.getString("FoodID"));%>')"><span class="glyphicon glyphicon-remove"></span> Delete</a></td>
</tr>
<%                }
%>
</tbody>
</table>
</div>
<%
    String act = "";
    if (request.getParameter("act") != null) {
        act = request.getParameter("act");
    }
    if (act.equals("deleteFood")) {
        %><jsp:include page="deleteFood.jsp" /> <%
    }
%>
<script>
    function deleteData(id){
        swal({
            title: "Delete",
            text: "Are you sure you want to delete this data?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes',
            cancelButtonText: "No",
            closeOnConfirm: false

        },
        function(){window.location = '?t=listFood&act=deleteFood&id='+id} 
    )}
</script>