<li class = "nav-item">
    <a href = "{{url('/edit-user')}}" class = "nav-link" id = "payments-tab" role = "tab" aria-controls = "payments" aria-selected = "true"><i class = "mdi mdi-account-edit"></i> Modifier le compte</a>
</li>
<li class = "nav-item">
    <a href = "{{url('/edit-image-profil')}}" class = "nav-link" id = "payments-tab" role = "tab" aria-controls = "payments" aria-selected = "true"><i class = "mdi mdi-pencil-box"></i> Modifier l'image</a>
</li>
<li class = "nav-item">
    <a href = "{{url('/edit-password-profil')}}" class = "nav-link" id = "payments-tab" role = "tab" aria-controls = "payments" aria-selected = "true"><i class = "mdi mdi-pencil-lock"></i> Modifier le Password</a>
</li>
@if (session('type') == 'Admin')
    <li class = "nav-item">
        <a href = "javascript:void(0)" class = "nav-link" id = "payments-tab" role = "tab" aria-controls = "payments" aria-selected = "true" onclick = "questionDeleteCompte()"><i class = "mdi mdi-account-remove"></i> Supprimer le compte</a>
    </li>
@endif