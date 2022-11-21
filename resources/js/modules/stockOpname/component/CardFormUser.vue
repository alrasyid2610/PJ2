<template>
    <div class="card">
        <div class="card-body">
            <div class="tab-content p-0">
                <h3 v-if="isUpdatePages">Ini halaman pages</h3>
                <h3>Data User</h3>
                    <div class="row">
                        <div class="col-12 col-12">
                            <label for="name">Radius</label>
                            <div class="field-checkbox">
                                <Checkbox id="binary" v-model="isRadius" :binary="true" @change="change" />
                                <label for="binary">Is Radius</label>
                            </div>
                            <!-- <div class="field-radiobutton">
                                <RadioButton id="city2" name="city" value="Los Angeles" v-model="city" @change="change"></RadioButton>
                                <label for="city2">Los Angeles</label>
                            </div> -->
                        </div>


                        <div class="col-md-6 col-12">
                            <label for="name">Nama</label>
                            <input-text class="p-inputtext-sm w-100" :class="{'p-invalid': errors.name[0] || validation.name.error}" placeholder="Name" v-model="d_users.name"></input-text>
                            <small id="username2-help" class="p-error" v-if="validation.name.error"> {{ validation.name.message }} </small>
                            <small id="username2-help" class="p-error" v-if="errors.name[0]">{{ errors.name[1] }}</small>
                        </div>
                        <div class="col-md-6 col-12">
                            <label for="nik">Email</label>
                            (Klik Jika email ingin kosong <Checkbox id="binary" v-model="isKosong" :binary="true" @change="emailKosong()" /> )
                            <input-text class="p-inputtext-sm w-100" placeholder="Email" v-model="d_users.email" :class="{'p-invalid': errors.email[0] || validation.email.error}"></input-text>
                            <small id="username2-help" class="p-error" v-if="validation.email.error"> {{ validation.email.message }} </small>
                            <!-- <small id="username2-help" class="p-error" v-if="errors.email[0]">{{ errors.email[1] }}</small> -->
                        </div>
                        <div class="col-md-6 col-12">
                            <label for="section">Section</label>
                            <Dropdown v-if="isUpdatePages" class="w-100" :class="{'p-invalid': errors.section[0] || validation.section.error}" :options="sectionArray" optionLabel="name" optionValue="code" v-model="d_users.sectionArray.code" placeholder="Select a Section" />
                            <Dropdown v-else class="w-100" :class="{'p-invalid': errors.section[0] || validation.section.error}" :options="sectionArray" :filter="true" optionLabel="name"  placeholder="Select a Section" v-model="d_users.sectionArray"/>
                            <small id="username2-help" class="p-error" v-if="validation.section.error"> {{ validation.section.message }} </small>
                            <small id="username2-help" class="p-error" v-if="errors.section[0]">{{ errors.section[1] }}</small>
                        </div>
                        <div class="col-md-6 col-12">
                            <label for="location">Factory</label>
                            <Dropdown :class="{'p-invalid' : errors.factory[0] || validation.factory.error}" class="w-100" :options="factory" optionLabel="name" optionValue="code" placeholder="Select a Factory" v-model="d_users.factory"/>
                            <!-- <small id="username2-help" class="p-error" v-if="validation.location.error"> {{ validation.location.message }} </small> -->
                            <small id="username2-help" class="p-error" v-if="validation.factory.error"> {{ validation.factory.message }} </small>
                            <small id="username2-help" class="p-error" v-if="errors.factory[0]">{{ errors.factory[1] }}</small>
                        </div>
                        <!-- <div class="col-12">
                            <Button label="Submit" class="p-button-sm" type="submit"/>
                        </div> -->
                    </div>

                <Toast position="bottom-right">
                    <template #message="slotProps">
                        <div class="flex flex-column">
                            <div class="text-center">
                                <i class="pi pi-exclamation-triangle" style="font-size: 3rem"></i>
                                <h4>{{slotProps.message.summary}}</h4>
                                <p>{{slotProps.message.detail}}</p>
                            </div>
                        </div>
                    </template>
                </Toast>
                <!-- <Button label="Success" class="p-button-success" @click="showSuccess" /> -->
            </div>
        </div><!-- /.card-body -->
    </div>
</template>

<script>

export default {
    props: {
        isUpdatePages: {
            type: Boolean,
            default: false
        }
    },
    inject: ['errors', 'users', 'sectionArray', 'factory', 'validation'],
    emits: ['ubah'],
    data() {
        return {
            isRadius: false,
            isKosong: false,
            categories: [
                {name: 'Accounting', key: 'A'},
                {name: 'Marketing', key: 'M'},
                {name: 'Production', key: 'P'},
                {name: 'Research', key: 'R'}
            ],
            d_errors: this.errors,
            d_users: this.users,
            d_section: this.sectionArray,
            d_validation: this.validation,
            d_factory: this.factory,
            pesan: ''
        }
    },
    computed: {
        validation() {
            return this.d_validation;
        },

        errors() {
            return this.d_errors;
        },
        users() {
            return this.d_users;
        },
        sectionArray() {
            return this.d_section;
        },
        factory() {
            return this.d_factory;
        },
        // users() {
        //     return this.d_users;
        // },

    },

    methods: {
        emailKosong() {
            if(this.isKosong) {
                this.users.email = "kosong@dnpi.co.id"
            } else {
                this.users.email = ""
            }
        },
        change() {
            if (this.isRadius) {
                this.users.name = "Radius"
                this.users.email = "radius@dnpi.co.id"
            } else {
                this.users.name = ""
                this.users.email = ""
            }
        },
        isError(name) {
            const a = this.d_validation.filter((validationData) => {
                    validationData.name === name
            });
            return a.error;
        },
        ubah() {
            this.$emit('ubah', this.pesan);
        },

        submit() {
            // console.log(this.d_users);
            this.$emit('submit', this.d_users);
        }
    }
}

</script>
