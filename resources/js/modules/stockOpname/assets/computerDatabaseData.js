// data for processor
const processor = {
    processor: [
                {name:'Intel ® Core™ i5-6500 Processor',code:'Intel &reg; Core&trade; i5-6500 Processor'},
                {name:'Intel ® Core™ i5-4590 Processor',code:'Intel &reg; Core&trade; i5-4590 Processor'},
                {name:'Intel ® Core™ i5-3470 Processor',code:'Intel &reg; Core&trade; i5-3470 Processor'},
                {name:'Intel ® Core™ i3-8100 Processor',code:'Intel &reg; Core&trade; i3-8100 Processor'},
                {name:'Intel ® Core™ i3-7100 Processor',code:'Intel &reg; Core&trade; i3-7100 Processor'},
                {name:'Intel ® Core™ i3-7100T Processor',code:'Intel &reg; Core&trade; i3-7100T Processor'},
                {name:'Intel ® Core™ i3-6100 Processor',code:'Intel &reg; Core&trade; i3-6100 Processor'},
                {name:'Intel ® Core™ i3-6100T Processor',code:'Intel &reg; Core&trade; i3-6100T Processor'},
                {name:'Intel ® Core™ i3-4160 Processor',code:'Intel &reg; Core&trade; i3-4160 Processor'},
                {name:'Intel ® Core™ i3-4100M Processor',code:'Intel &reg; Core&trade; i3-4100M Processor'},
                {name:'Intel ® Core™ i3-3240 Processor',code:'Intel &reg; Core&trade; i3-3240 Processor'},
                {name:'Intel ® Core™2 Duo Processor E7500',code:'Intel &reg; Core&trade;2 Duo Processor E7500'},
                {name:'Intel ® Pentium ® Processor E5700',code:'Intel &reg; Pentium &reg; Processor E5700'},
                {name:'Intel ® Pentium ® Processor E5500',code:'Intel &reg; Pentium &reg; Processor E5500'},
                {name:'Intel ® Pentium ® Processor E5400',code:'Intel &reg; Pentium &reg; Processor E5400'},
                {name:'Intel ® Pentium ® Processor E5300',code:'Intel &reg; Pentium &reg; Processor E5300'},
                {name:'Intel ® Pentium ® Processor E5200',code:'Intel &reg; Pentium &reg; Processor E5200'},
                {name:'Intel ® Pentium ® Processor E2200',code:'Intel &reg; Pentium &reg; Processor E2200'},
                {name:'Intel ® Pentium ® Processor E2180',code:'Intel &reg; Pentium &reg; Processor E2180'},
                {name:'Intel ® Pentium ® Processor G2030',code:'Intel &reg; Pentium &reg; Processor G2030'},
                {name:'Intel ® Pentium ® Processor G2020',code:'Intel &reg; Pentium &reg; Processor G2020'},
                {name:'Intel ® Pentium ® Processor G2010',code:'Intel &reg; Pentium &reg; Processor G2010'},
                {name:'Intel ® Pentium ® Processor G630',code:'Intel &reg; Pentium &reg; Processor G630'},
                {name:'Intel ® Pentium ® 4 Processor',code:'Intel &reg; Pentium &reg; 4 Processor'},
                {name:'Intel ® Xeon ® Processor 3040',code:'Intel &reg; Xeon &reg; Processor 3040'},
    ],
}

// data for os
const os = {
    os: [
        {name:'Windows 10 Pro 64bit', code:'Windows 10 Pro 64bit'},
        {name:'Windows 10 Pro 32bit', code:'Windows 10 Pro 32bit'},
        {name:'Windows 7 64bit', code:'Windows 7 64bit'},
        {name:'Windows 7 32bit', code:'Windows 7 32bit'},
        {name:'Windows XP 64bit', code:'Windows XP 64bit'},
        {name:'Windows XP 32bit', code:'Windows XP 32bit'},
    ],
}

// data for ms office
const ms_office = {
    ms_office: [
        {name: 'Microsoft Office 2007',code: 'Microsoft Office 2007'},
        {name: 'Microsoft Office 2010',code: 'Microsoft Office 2010'},
        {name: 'Microsoft Office 2013',code: 'Microsoft Office 2013'},
        {name: 'Microsoft Office 2019',code: 'Microsoft Office 2019'}
    ],
}

// data for antivirus
const antivirus = {
    antivirus: [
        {name: 'Trend Micro', code: 'Trend Micro'},
        {name: 'Morpisec', code: 'Morpisec'},
    ],
}

//data for brand
const brand = {
    brand: [
        {name: 'Rakitan', code: 'Rakitan'},
        {name: 'HP', code: 'HP'},
        {name: 'ASUS', code: 'ASUS'},
        {name: 'DELL', code: 'DELL'},
    ],
}

// data for usage_type
const usage_type = {
    usage_type: [
        {name: "Together", code: "Together"},
        {name: "Alone", code: "Alone"},
    ],
}

// data for location
const location = {
    location: [
        {name: "PLG", code: "PLG"},
        {name: "KRW", code: "KRW"},
    ],
}

// data for status_fix_asset
const status_fix_asset = {
    status_fix_asset: [
        {name: "Ada", code: true},
        {name: "Tidak Ada", code: false},
    ],
}

export {processor, os, ms_office, antivirus, brand, usage_type, location, status_fix_asset}
