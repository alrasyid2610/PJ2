<template>
    <Card>
        <template #header>
            <Button icon="pi pi-refresh" class="ml-2 mt-2"  aria-label="Refresh" size="small" />
        </template>
        <template #content>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="box">
                        <h4>Item Not Found</h4>
                        <div class="number">
                            5
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="box">
                        <h4>Item Not Found</h4>
                        <div class="number">
                            5
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="box">
                        <h4>Item Not Found</h4>
                        <div class="number">
                            5
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="box">
                        <h4>Item Not Found</h4>
                        <div class="number">
                            5
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </Card>

</template>

<script setup>
</script>

<style scoped>
.p-button.p-button-icon-only {
    width: 2rem;
    height: 2rem;
    padding: 0.75rem 0;
}

.box {
    background-color: rgba(57, 204, 44, 0.685);
    padding: 8px 12px 24px;
    border-radius: 4px;
    box-shadow: -3px 4px 8px #b1b1b173;
}

.box h4 {
    font-size: 1rem;
    text-align: center;
    text-transform: capitalize;
    margin: 0;
    margin-bottom: 20px;
}

.box .number {
    text-align: center;
    font-size: 2rem;
}
</style>
