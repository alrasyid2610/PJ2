const perangkatJaringan = {
    perangkatJaringan: [
        {
            "namaPerangkat" : "HUB POE SALES",
            "type" : "HUB",
            "lokasi" : "PLG",
            "tahunBeli" : "2018",
            "attr" : {
                "brand": "Smart Switch",
                "networks": [
                    {
                        "idNetwork": "2",
                    }
                ],
                "portDetail": {
                    "1": {
                        "idPerangkatTujuan": "2",
                        "portTujuan": "1",
                        "namaPerangkatTujuan": "Access Point Depan Pak Harli"
                    },
                    "2": {},
                    "3": {},
                    "4": {},
                    "5": {},
                    "6": {},
                    "7": {},
                    "8": {},
                    // "jumlahPort": 8
                }
            }
        },
        {
            "namaPerangkat" : "HUB POE EDP",
            "type" : "HUB",
            "lokasi" : "PLG",
            "tahunBeli" : "2018",
            "attr": {
                "brand": "Smart Switch",
                "networks": [
                    {
                        "idNetwork": "3",
                    }
                ],
                "portDetail": {
                    "1": {
                        "idPerangkatTujuan": "4",
                        "portTujuan": "1",
                        "namaPerangkatTujuan": "Access Point Sakura1"
                    },
                    "2": {},
                    "3": {},
                    "4": {},
                    "5": {},
                    "6": {},
                    "7": {},
                    "8": {},
                }
            }
        }
    ]
}

const lokasiJaringan = {
    lokasi: [
        {name: 'EDP SERVER', value: 'EDP SERVER'},
        {name: 'Loby PLG', value: 'Loby PLG'},
        {name: 'Depan Orchid 3', value: 'Depan Orchid 3'},
        {name: 'Depan Orchid 1', value: 'Depan Orchid 1'},
        {name: 'Depan Ruangan Pak Harli', value: 'Depan Ruangan Pak Harli'},
    ]
}


export { lokasiJaringan, perangkatJaringan }
