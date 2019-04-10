const roles = document.getElementById('roles');

if(roles){
  roles.addEventListener('click', e => {
      if(e.target.className === 'btn btn-sm btn-danger delete-role'){
        if(confirm('Are you sure you want to delete the role?')){
          const id = e.target.getAttribute('data-id');

          fetch(`/role/delete/${id}`, {
            method: 'DELETE'
          }).then(res => window.location.reload());
        }
      }
    }
  );
}
