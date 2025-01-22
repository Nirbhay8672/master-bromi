<template>
    <div>
        <div class="page-body">
            <div class="container-fluid">
                <div class="page-title">
                    <div class="row">
                        <div class="col-6">
                            <h3>Branches
                                <a class="btn custom-icon-theme-button tooltip-btn" href="{{ route('admin.settings') }}"
                                    data-tooltip="Back" style="float: inline-end;">
                                    <i class="fa fa-backward"></i>
                                </a>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header pb-0">
                                <div class="row mt-2 mb-2">
                                    <div class="col">
                                        <button class="btn custom-icon-theme-button tooltip-btn" type="button"
                                            data-bs-toggle="modal" data-bs-target="#branchModal"
                                            data-tooltip="Add Branch">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                        <button class="btn text-white delete_table_row ms-3 tooltip-btn"
                                            style="border-radius: 5px;display: none;background-color:red" type="button"
                                            @click="deleteTableRow()" data-tooltip="Delete">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="display" id="branchTable">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px !important;">
                                                    <div class="form-check form-check-inline checkbox checkbox-dark mb-0 me-0">
                                                        <input class="form-check-input" id="select_all_checkbox"
                                                            name="selectrows" type="checkbox" @click="selectall">
                                                        <label class="form-check-label" for="select_all_checkbox"></label>
                                                    </div>
                                                </th>
                                                <th>Branch</th>
                                                <th>City</th>
                                                <th>status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(branch, index) in branches" :key="index">
                                                <td>
                                                    <div class="form-check form-check-inline checkbox checkbox-dark mb-0 me-0">
                                                        <input class="form-check-input" :id="`select_checkbox_${index}`"
                                                            name="selectrows" type="checkbox" @click="selectSingle"
                                                            :data-id="branch.id">
                                                        <label class="form-check-label"
                                                            :for="`select_checkbox_${index}`"></label>
                                                    </div>
                                                </td>
                                                <td>{{ branch.name }}</td>
                                                <td>{{ branch.city.name }}</td>
                                                <td>
                                                    <span class="badge"
                                                        :class="{'bg-success': branch.status == 1, 'bg-danger': branch.status == 0}">{{ branch.status ? 'Active' : 'Inactive' }}</span>
                                                </td>
                                                <td>
                                                    <button class="btn btn-primary" @click="getBranch(branch.id)">
                                                        <i class="fa fa-pencil-square-o"></i>
                                                    </button>
                                                    <button class="btn btn-danger" @click="deleteBranch(branch.id)">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="branchModal" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Branch</h5>
                            <button class="btn-close btn-light" type="button" data-bs-dismiss="modal"
                                aria-label="Close"> </button>
                        </div>
                        <div class="modal-body">
                            <form class="form-bookmark needs-validation " method="post" id="modal_form" novalidate="">
                                <div class="row">
                                    <div class="form-group col-md-8 m-b-20">
                                        <label for="Branch Name">Branch Name</label>
                                        <input class="form-control" name="branch_name" id="branch_name" type="text"
                                            required autocomplete="off" v-model="branch.name">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4 m-b-20">
                                        <label class="mb-0">State</label>
                                        <select class="form-select" id="state_id" required v-model="branch.state_id">
                                            <option value="" disabled>State</option>
                                            <option v-for="state in states" :key="state.id" :value="state.id">
                                                {{ state.name }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4 m-b-20">
                                        <label class="mb-0">City</label>
                                        <select class="form-select" id="city_id" required v-model="branch.city_id">
                                            <option value="" disabled>City</option>
                                            <option v-for="city in cities" :key="city.id" :value="city.id">
                                                {{ city.name }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4 m-b-20">
                                        <label class="mb-0">Locality</label>
                                        <select id="area_id" v-model="branch.area_id">
                                            <option value=""> Locality</option>
                                            <option v-for="area in areas" :key="area.id" :value="area.id">
                                                {{ area.name }}
                                            </option>
                                        </select>
                                    </div>
                                    <input type="hidden" name="this_data_id" id="this_data_id" v-model="branch.id">
                                    <div class="form-check checkbox  checkbox-solid-success mb-0 col-md-5 m-b-20">
                                        <input class="form-check-input" id="branch_active" type="checkbox"
                                            v-model="branch.status">
                                        <label class="form-check-label" for="branch_active">Active</label>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button class="btn custom-theme-button" id="saveBranch" @click="saveBranch">
                                        Save
                                    </button>
                                    <button class="btn btn-secondary ms-3" style="border-radius: 5px;" type="button"
                                        data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import Swal from 'sweetalert2';

const branches = ref([]);
const branch = ref({
    name: '',
    state_id: '',
    city_id: '',
    area_id: '',
    status: 1,
    id: ''
});
const shouldchangecity = ref(1);
const states = @json($state_encoded);
const cities = @json($city_encoded);
const areas = @json($area_encoded);

const getBranches = () => {
    axios.post("{{ route('admin.branches') }}")
        .then(response => {
            branches.value = response.data;
        });
};

const getBranch = (id) => {
    axios.post("{{ route('admin.getBranch') }}", { id: id })
        .then(response => {
            Object.assign(branch.value, response.data);
            document.getElementById('city_id').disabled = false;
            document.getElementById('area_id').disabled = false;
            $('#branchModal').modal('show');
        });
};

const saveBranch = () => {
    if (!branch.value.name || !branch.value.state_id || !branch.value.city_id || !branch.value.area_id) {
        Swal.fire({
            title: "Please fill in all the required fields",
            icon: "warning",
        });
        return;
    }
    axios.post("{{ route('admin.saveBranch') }}", {
        id: branch.value.id,
        name: branch.value.name,
        state_id: branch.value.state_id,
        city_id: branch.value.city_id,
        area_id: branch.value.area_id,
        status: branch.value.status,
        _token: '{{ csrf_token() }}'
    })
        .then(response => {
            $('#branchTable').DataTable().draw();
            $('#branchModal').modal('hide');
        });
};

const deleteBranch = (id) => {
    Swal.fire({
        title: "Are you sure?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: 'Yes',
    }).then(isConfirm => {
        if (isConfirm.isConfirmed) {
            axios.post("{{ route('admin.deleteBranch') }}", { id: id, _token: '{{ csrf_token() }}' })
                .then(response => {
                    $('#branchTable').DataTable().draw();
                });
        }
    });
};

const   = (e) => {
    const checked = e.target.checked;
    $('.table_checkbox').prop('checked', checked);
};

onMounted(() => {
    getBranches();
});
</script>

