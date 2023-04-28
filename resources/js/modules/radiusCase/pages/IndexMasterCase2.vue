<template>
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <div class="col-12">
                    <h3>Radius Histories <Button icon="pi pi-plus" severity="info" aria-label="Notification" size="small" /> </h3>
                </div>
                <section class="col-lg-12" v-once>
                    <card>
                        <template #content>
                            <!-- <Form @submit="onSubmit">
                                <Field name="email" type="email" :rules="validateEmail" v-if="true"/>
                                <ErrorMessage name="email" />
                                <button>Sign up for newsletter</button>
                            </Form> -->

                            <!-- <Form @submit="onSubmit">
                                <div class="form-group">
                                    <Field name="mesin" v-slot="{ field }" :rules="mesin">
                                        <input-text class="p-inputtext-sm w-100" placeholder="Masukan Mesin" v-bind="field"></input-text>
                                        <ErrorMessage name="mesin" />
                                    </Field>
                                </div>

                                <button>Hello</button>
                            </Form> -->

                            <form action="" @submit="onSubmit">
                                <div class="form-group">
                                    <Field name="mesin" v-slot="{ field }" :rules="mesin">
                                        <input-text class="p-inputtext-sm w-100" placeholder="Masukan Mesin" v-bind="field"></input-text>
                                        <ErrorMessage name="mesin" />
                                    </Field>
                                </div>

                                <button>Hello</button>
                            </form>


                            <!-- <form action="" @submit.prevent="onSubmit">
                                <input type="email" name="kocak" id="">
                                <button type="Submit">Submit</button>
                            </form> -->

                        </template>
                    </card>
                </section>
            <!-- /.Left col -->
            </div>

            <div class="row">
            </div>

            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <Toast position="bottom-right" />
</template>

<script setup>
import { Form, Field, ErrorMessage, useForm } from 'vee-validate';
import * as yup from 'yup';

const { handleSubmit } = useForm();

const onSubmit = handleSubmit((values) => {
    console.log(values);
    console.log('okeoke');
})

const validateEmail = (value) => {
      // if the field is empty
      if (!value) {
        return 'This field is required';
      }
      // if the field is not a valid email
      const regex = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
      if (!regex.test(value)) {
        return 'This field must be a valid email';
      }
      // All is good
      return true;
    }

const isReuired = (value) => {
    console.log(value)
    if (value && value.trim()) {
        return true;
    }

    return false;
}

const mesin = yup.string().required().min(5);
const passwordRules = yup.string().required().min(8);
</script>
