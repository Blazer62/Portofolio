@extends('layouts.app')

@section('content')
    @include('portfolio.hero')
    @include('portfolio.about')
    @include('portfolio.skills')
    @include('portfolio.projects')
    @include('portfolio.contact')
@endsection

@push('scripts')
<script>
(function() {
    var form = document.getElementById('projectForm');
    var methodInput = document.getElementById('formMethod');

    window.openEditModal = function(project) {
        openModal('addModal');
        document.getElementById('modalTitle').innerText = 'Edit Project';
        document.getElementById('submitBtn').innerText = 'Simpan Perubahan';

        document.getElementById('projectId').value = project.id;
        document.getElementById('projectTitle').value = project.title;
        document.getElementById('projectDesc').value = project.description;
        document.getElementById('projectImg').value = '';
        document.getElementById('projectLink').value = project.live_link;
        document.getElementById('projectTech').value = project.tech_stack;

        form.action = '/projects/' + project.id;
        methodInput.name = '_method';
        methodInput.value = 'PUT';
    };

    window.confirmDelete = function(id) {
        document.getElementById('deleteProjectId').value = id;
        document.getElementById('deleteForm').action = '/projects/' + id;
        openModal('deleteModal');
    };

    var addBtn = document.querySelector('[onclick="openModal(\'addModal\')"]');
    if (addBtn) {
        addBtn.onclick = function() {
            document.getElementById('modalTitle').innerText = 'Project Baru';
            document.getElementById('submitBtn').innerText = 'Publish Project';
            document.getElementById('projectId').value = '';
            document.getElementById('projectTitle').value = '';
            document.getElementById('projectDesc').value = '';
            document.getElementById('projectImg').value = '';
            document.getElementById('projectLink').value = '';
            document.getElementById('projectTech').value = '';
            form.action = '{{ route("projects.store") }}';
            methodInput.name = '_method';
            methodInput.value = 'POST';
            openModal('addModal');
        };
    }
})();
</script>
@endpush
