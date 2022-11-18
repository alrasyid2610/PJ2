<template>
    <div class="card">
        <div class="card-body">
            <div class="tab-content p-0">
                <h3>Data Computer</h3>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <label for="pc_name">PC Name</label>
                            <input-text class="p-inputtext-sm w-100" :class="{'p-invalid': validation.pc_name.error}" placeholder="PC Name" v-model="computer.pc_name"></input-text>
                            <small id="username2-help" class="p-error" v-if="validation.pc_name.error"> {{ validation.pc_name.message2 }} </small>
                        </div>
                        <div class="col-md-6 col-12">
                            <label for="processor">Processor</label>
                            <Dropdown optionValue="code" v-model="computer.processor" class="w-100" :class="{'p-invalid': validation.processor.error}" :filter="true" :options="processor" optionLabel="name" placeholder="Select a Processor" />
                            <small id="username2-help" class="p-error" v-if="validation.processor.error"> {{ validation.processor.message }} </small>
                            <!-- <small id="username2-help" class="p-error" v-if="errors.location[0]">{{ errors.location[1] }}</small> -->
                        </div>
                        <div class="col-md-6 col-12">
                            <label for="os">Operation System</label>
                            <Dropdown optionValue="name" :class="{'p-invalid': validation.os.error}" v-model="computer.os" class="w-100" :options="os" optionLabel="name" placeholder="Select a Operation System" />
                            <small id="username2-help" class="p-error" v-if="validation.os.error"> {{ validation.os.message }} </small>
                            <!-- <small id="username2-help" class="p-error" v-if="errors.location[0]">{{ errors.location[1] }}</small> -->
                        </div>
                        <div class="col-md-6 col-12">
                            <label for="pc_name">Ram</label>
                            <input-text :class="{'p-invalid': validation.ram.error}" v-model="computer.ram" class="p-inputtext-sm w-100" placeholder="RAM"></input-text>
                            <small id="username2-help" class="p-error" v-if="validation.ram.error"> {{ validation.ram.message }} </small>
                            <!-- <small id="username2-help" class="p-error"></small> -->
                        </div>
                        <div class="col-md-6 col-12">
                            <label for="pc_name">Hdd</label>
                            <input-text :class="{'p-invalid': validation.hdd.error}" v-model="computer.hdd" class="p-inputtext-sm w-100" placeholder="HDD"></input-text>
                            <small id="username2-help" class="p-error" v-if="validation.hdd.error"> {{ validation.hdd.message }} </small>
                            <!-- <small id="username2-help" class="p-error"></small> -->
                        </div>
                        <div class="col-md-6 col-12">
                            <label for="pc_name">IP</label>
                            <input-text :class="{'p-invalid': validation.ip.error}" v-model="computer.ip" class="p-inputtext-sm w-100" placeholder="IP"></input-text>
                            <small id="username2-help" class="p-error" v-if="validation.ip.error"> {{ validation.ip.message2 }} </small>
                            <!-- <small id="username2-help" class="p-error"></small> -->
                        </div>
                        <div class="col-md-6 col-12">
                            <label for="os">Microsoft Office</label>
                            <Dropdown optionValue="code" :class="{'p-invalid': validation.ms_office.error}" v-model="computer.ms_office" class="w-100" :options="ms_office" optionLabel="name" placeholder="Select a MS Office" />
                            <!-- <Dropdown optionValue="code" :class="{'p-invalid': validation.ms_office.error}" v-model="computer.ms_office.code" class="w-100" :options="ms_office" optionLabel="name" placeholder="Select a Microsoft Office" /> -->
                            <small id="username2-help" class="p-error" v-if="validation.ms_office.error"> {{ validation.ms_office.message }} </small>
                            <!-- <small id="username2-help" class="p-error" v-if="errors.location[0]">{{ errors.location[1] }}</small> -->
                        </div>
                         <div class="col-md-6 col-12">
                            <label for="os">Antivirus</label>
                            <MultiSelect :class="{'p-invalid': validation.antivirus.error}" v-model="computer.antivirus" class="w-100 p-multiselect-label-container p-multiselect-item" :options="antivirus" optionLabel="code" placeholder="Select Antivirus" display="chip"/>
                            <small id="username2-help" class="p-error" v-if="validation.antivirus.error"> {{ validation.antivirus.message }} </small>
                            <!-- <small id="username2-help" class="p-error" v-if="errors.location[0]">{{ errors.location[1] }}</small> -->
                        </div>

                        <div class="col-md-2 col-lg-6 col-12">
                            <label for="os" class="d-block">Wsus <sub>Optional</sub></label>
                            <!-- <MultiSelect v-model="selectedAntivirus" class="w-100 p-multiselect-label-container p-multiselect-item" :options="antivirus" optionLabel="name" placeholder="Select Brands" display="chip"/> -->
                            <InputSwitch :class="{'p-invalid': validation.wsus.error}" v-model="computer.wsus" />
                            <small id="username2-help" class="p-error" v-if="validation.wsus.error"> {{ validation.wsus.message }} </small>
                            <!-- <small id="username2-help" class="p-error" v-if="errors.location[0]">{{ errors.location[1] }}</small> -->
                        </div>
                        <div class="col-md-4 col-lg-6 col-12">
                            <label for="pc_name">User Login</label>
                            <input-text :class="{'p-invalid': validation.user_login.error}" v-model="computer.user_login" class="p-inputtext-sm w-100" placeholder="User Login" name="user_login"></input-text>
                            <small id="username2-help" class="p-error" v-if="validation.user_login.error"> {{ validation.user_login.message }} </small>
                            <!-- <small id="username2-help" class="p-error"></small> -->
                        </div>
                        <div class="col-md-6 col-12">
                            <label for="os">Brand PC</label>
                            <Dropdown optionValue="code" :class="{'p-invalid': validation.brand.error}" v-model="computer.brand" class="w-100" :options="brand" optionLabel="name" placeholder="Select a Brand PC" />
                            <small id="username2-help" class="p-error" v-if="validation.brand.error"> {{ validation.brand.message }} </small>
                            <!-- <small id="username2-help" class="p-error" v-if="errors.location[0]">{{ errors.location[1] }}</small> -->
                        </div>
                        <div class="col-md-6 col-12">
                            <label for="os">Usage Type</label>
                            <Dropdown optionValue="code" :class="{'p-invalid': validation.usage_type.error}" v-model="computer.usage_type" class="w-100" :options="usage_type" optionLabel="name" placeholder="Select a Usege Type PC" />
                            <small id="username2-help" class="p-error" v-if="validation.usage_type.error"> {{ validation.usage_type.message }} </small>
                            <!-- <small id="username2-help" class="p-error" v-if="errors.location[0]">{{ errors.location[1] }}</small> -->
                        </div>
                        <!-- <div class="col-md-6 col-12">
                            <label for="os">Location</label>
                            <Dropdown v-model="computer.location" class="w-100" :options="location" optionLabel="name" placeholder="Select a Location Factory" />
                        </div> -->

                        <!-- <div class="col-md-6 col-12">
                            <label for="nik">Email</label>
                            <input-text class="p-inputtext-sm w-100" placeholder="Email" v-model="d_users.email" :class="{'p-invalid': errors.email[0]}"></input-text>
                            <small id="username2-help" class="p-error" v-if="errors.email[0]">{{ errors.email[1] }}</small>
                        </div>
                        <div class="col-md-6 col-12">
                            <label for="section">Section</label>
                            <Dropdown class="w-100" :class="{'p-invalid': errors.section[0]}" :options="section" optionLabel="name" placeholder="Select a Section" v-model="d_users.section"/>
                            <small id="username2-help" class="p-error" v-if="errors.section[0]">{{ errors.section[1] }}</small>
                        </div>

                        <div class="col-12">
                            <Button label="Submit" class="p-button-sm" type="submit"/>
                        </div> -->
                    </div>

                    <h4 class="mt-4">Fix Asset</h4>

                    <div class="row">
                        <div class="col-md-12 col-12">
                            <label for="os">Status Fix Asset</label>
                            <Dropdown @change="test" :class="{'p-invalid': validation.status_fix_asset.error}" v-model="computer.status_fix_asset" class="w-100" :options="status_fix_asset" optionLabel="name" placeholder="Select a Status Fix Asset"  />
                            <small id="username2-help" class="p-error" v-if="validation.status_fix_asset.error"> {{ validation.status_fix_asset.message }} </small>
                            <!-- <small id="username2-help" class="p-error" v-if="errors.location[0]">{{ errors.location[1] }}</small> -->
                        </div>

                        <div class="col-md-4 col-12"  v-if="a">
                            <!-- <label for="os">Fix Asset Date</label> -->
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="date" :class="{'is-invalid': validation.date_fa.error}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" v-model="computer.date_fa">
                                <small id="username2-help" class="p-error" v-if="validation.date_fa.error"> {{ validation.date_fa.message }} </small>
                                <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                            </div>
                            <!-- <input type="date"> -->
                            <!-- <Calendar :class="{'p-invalid': validation.date_fa.error}" class="w-100" id="basic" v-model="computer.date_fa" autocomplete="off" dateFormat="dd/mm/yy" /> -->
                            <!-- <Dropdown v-model="computer.date_fa" class="w-100" :options="[{name: 'Ada Fix Asset', code: 'Ada Fix Asset'},{name: 'Tidak ada Fix Asset', code: 'Tidak ada Fix Asset'}]" optionLabel="name" placeholder="Select a Microsoft Office" /> -->
                            <!-- <small id="username2-help" class="p-error" v-if="errors.location[0]">{{ errors.location[1] }}</small> -->
                        </div>
                        <div class="col-md-6 col-lg-4 col-12" v-if="a">
                            <label for="pc_name">No Fixasset</label>
                            <input-text :class="{'p-invalid': validation.no_fa.error}" v-model="computer.no_fa" class="p-inputtext-sm w-100" placeholder="No Fix Asset"></input-text>
                            <small id="username2-help" class="p-error" v-if="validation.no_fa.error"> {{ validation.no_fa.message }} </small>
                            <small id="username2-help" class="p-error"></small>
                        </div>
                        <div class="col-md-6 col-lg-4 col-12" v-if="a">
                            <label for="pc_name">No EDP</label>
                            <input-text :class="{'p-invalid': validation.edp_no_fa.error}" v-model="computer.edp_no_fa" class="p-inputtext-sm w-100" placeholder="No EDP Fix Asset"></input-text>
                            <small id="username2-help" class="p-error" v-if="validation.edp_no_fa.error"> {{ validation.edp_no_fa.message }} </small>
                            <small id="username2-help" class="p-error"></small>
                        </div>
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
import {processor, os, ms_office, antivirus, brand, usage_type, location, status_fix_asset} from "../assets/computerDatabaseData.js";

export default {
    inject: ['computer', 'validation'],
    data() {
        return {
            a: false,
            processorSelected: null,
            osSelected: null,
            selectedAntivirus: null,
            d_validation: this.validation,
            selectedMsOffice: null,
            selectedWsus: null,
            ...processor,
            ...os,
            ...ms_office,
            ...antivirus,
            ...brand,
            ...usage_type,
            ...location,
            ...status_fix_asset,
            // Data Computer
            d_computer: this.computer
        }
    },

    computed: {
        computer() {
            return this.d_computer;
        },
        validation() {
            return this.d_validation;
        },
        a() {
            return this.computer.status_fix_asset.code;
        }
    },

    methods: {
        test() {
            this.a = this.computer.status_fix_asset;
        }
    }
}

</script>

<style>
.p-multiselect.p-multiselect-chip .p-multiselect-token {
    padding: 0.375rem 0.75rem;
    margin-right: 0.5rem;
    background: #97d356 !important;
    color: #ffffff !important;
    border-radius: 16px;
}
</style>
