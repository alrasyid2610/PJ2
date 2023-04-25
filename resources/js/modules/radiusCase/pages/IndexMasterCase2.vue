<template>
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <div class="col-12">
                    <h3>Radius Case Master {{ a }}</h3>
                </div>
                <section class="col-lg-6" v-once>
                    <Form>
                        <Field name="field" :rules="isRequired" v-model="a"/>
                        <ErrorMessage name="field" />

                        <div>
                            <Field name="password" type="password" :rules="passwordRules" v-model="a"/>
                            <ErrorMessage name="password" />
                        </div>
                    </Form>
                </section>
            <!-- /.Left col -->
            </div>

            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <Toast position="bottom-right" />
</template>

<script setup>
import * as yup from 'yup';
import { ref } from 'vue';
import { Field, Form, ErrorMessage } from 'vee-validate';
const a = ref(null);
const passwordRules = yup.string().required().min(8);

function isRequired(value) {
    if (value && value.trim()) {
        return true;
    }
    return 'This is required';
}
</script>

<style>
.p-datepicker {
    min-width: 430px !important;
}
</style>
