<template>
    <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Input Case Radius</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Input Stock Opname</li>
                    </ol>
                </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

    <!-- Main section -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <h5>Nomor Barcode</h5>
                                <input-text class="p-inputtext-sm w-100" v-model="barcode"></input-text>
                                <Button label="Submit" class="sm mt-2" @click="submit"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            barcode: null,
        }
    },

    methods: {
        submit() {
            console.log(this.barcode)
            axios.get('/api/cekcek/', {
                })
                .then(function (response) {
                    const data = response.data.data;
                    console.log(response);
                    const message = response.data.message;
                    const success = response.data.success;


                })
                .catch(function (error) {
                    console.log(error);
                });
        },

    }
}
</script>
