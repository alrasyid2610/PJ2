<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div id="myDiagramDiv" style="width:400px; height:150px; background-color: #DAE4E4;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>



<script setup>
import * as go from "gojs"

var myDiagram = new go.Diagram("myDiagramDiv");
</script>
