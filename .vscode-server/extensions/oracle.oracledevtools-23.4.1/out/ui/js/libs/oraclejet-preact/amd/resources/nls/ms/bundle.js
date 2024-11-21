define(['exports'], (function(a){"use strict";const e={calendarDateConverter_parseError:a=>"Enter a complete date like this: "+a.dateExample+".",calendarMonthConverter_parseError:a=>"Enter a month and year like this: "+a.dateExample+".",chart_labelGroup:()=>"Kumpulan",chart_labelSeries:()=>"Siri",chart_labelValue:()=>"Nilai",checkboxSet_requiredMessageDetail:()=>"Diperlukan",checkbox_requiredMessageDetail:()=>"Diperlukan",close:()=>"Tutup",collection_noData:()=>"Tiada data untuk dipaparkan.",collection_selectAllRows:()=>"Pilih semua baris",collection_selectRow:a=>"Pilih baris "+a.ROW_NAME,collection_sortDisabled:()=>"Tidak boleh diisih",collection_sortEnabled:()=>"Boleh diisih",confirmation:()=>"Pengesahan",dataVisualization_labelAndValue:a=>a.LABEL+": "+a.VALUE,dataVisualization_labelCountWithTotal:a=>a.itemCount+" daripada "+a.totalCount,dataVisualization_noData:()=>"Tiada data untuk dipaparkan",dataVisualization_stateSelected:()=>"Dipilih",dataVisualization_stateUnselected:()=>"Dinyahpilih",error:()=>"Ralat",expandableList_expandCollapseInstructionText:()=>"Gunakan anak kekunci untuk kembangkan dan runtuhkan",expandableList_groupCollapse:()=>"Diruntuhkan",expandableList_groupExpand:()=>"Dikembangkan",filePicker_addFiles:()=>"Tambah Fail",filePicker_dropzonePrimaryText:()=>"Seret dan Lepaskan",filePicker_dropzoneSecondaryText:()=>"Pilih fail atau lepaskan satu fail di sini",filePicker_dropzoneSecondaryTextMultiple:()=>"Pilih atau lepaskan fail di sini",filePicker_multipleFileTypeUploadError:a=>"Anda tidak boleh memuat naik fail jenis: "+a.fileTypes,filePicker_singleFileUploadError:()=>"Muat naik satu fail pada satu-satu masa",filePicker_singleTypeUploadError:a=>"Anda tidak boleh memuat naik fail jenis "+a.fileType,filePicker_unknownFileTypeUploadError:()=>"tidak diketahui",formControl_clear:()=>"Kosongkan",formControl_day:()=>"Hari",formControl_helpAvailable:()=>"Bantuan tersedia",formControl_limitReached:a=>"Anda telah mencapai had sebanyak "+({one:"1 character"}[new Intl.PluralRules("ms").select(a.CHARACTER_LIMIT)]||new Intl.NumberFormat("ms").format(a.CHARACTER_LIMIT)+" characters")+".",formControl_loading:()=>"Memuatkan",formControl_maxLengthExceeded:a=>"Panjang maksimum "+a.MAX_LENGTH+" dicapai.",formControl_maxLengthRemaining:a=>a.CHARACTER_COUNT+" aksara lagi.",formControl_month:()=>"Bulan",formControl_readOnly:()=>"Baca sahaja",formControl_requiredMessageDetail:()=>"Masukkan nilai.",formControl_year:()=>"Tahun",gantt_labelDate:()=>"Tarikh",gantt_labelEnd:()=>"Tamat",gantt_labelLabel:()=>"Label",gantt_labelRow:()=>"Baris",gantt_labelStart:()=>"Mula",indexer_disabledLabel:a=>a.SECTION+". Tiada seksyen yang sepadan ditemui.",indexer_keyboardInstructionText:()=>"Tekan Enter untuk memilih nilai.",indexer_othersLabel:()=>"#",indexer_separatorLabel:a=>"Antara "+a.FROM_SECTION+" dengan "+a.TO_SECTION+".",indexer_touchInstructionText:()=>"Ketik dua kali dan tahan untuk memasuki mod gerak isyarat, kemudian seret ke atas atau ke bawah untuk melaraskan nilai.",info:()=>"Maklumat",inputDateMask_date_cleared:()=>"Tarikh dikosongkan",inputDateMask_dayPlaceholder:()=>"hh",inputDateMask_empty_segment:()=>"Kosong",inputDateMask_monthPlaceholder:()=>"bb",inputDateMask_yearPlaceholder:()=>"tttt",inputMonthMask_dateRangeOverflowMessageDetail:a=>"Enter a month and year that's on or before "+a.max+".",inputMonthMask_dateRangeUnderflowMessageDetail:a=>"Enter a month and year that's on or after "+a.min+".",inputNumber_converterParseError:()=>"Masukkan nombor.",inputNumber_decrease:()=>"Kurangkan",inputNumber_increase:()=>"Tambahkan",inputPassword_hidden:()=>"Kata Laluan Disembunyikan",inputPassword_hide:()=>"Sembunyikan Kata Laluan",inputPassword_show:()=>"Tunjukkan Kata Laluan",inputSensitiveText_hidden:()=>"Sensitive text hidden",list_suggestion:()=>"Cadangan",messageToast_allMessagesClosed:()=>"Semua mesej maklum balas ditutup.",message_close:()=>"Tutup",message_confirmation:()=>"Berjaya",message_error:()=>"Ralat",message_info:()=>"Maklumat",message_navigationFromMessagesRegion:()=>"Memasuki rantau mesej. Tekan F6 untuk menavigasi kembali ke elemen yang difokuskan sebelum ini.",message_navigationToMessagesRegion:()=>"Rantau mesej mengandungi mesej baru. Tekan F6 untuk menavigasi ke rantau mesej yang terkini.",message_warning:()=>"Amaran",noData_message:()=>"Tiada item untuk dipaparkan",overflowItemLabel:()=>"Lebih Banyak Tab",plural_separator:()=>", ",progressIndeterminate:()=>"Dalam Proses",radio_helpForRadio:()=>"Bantuan untuk butang radio",radio_requiredMessageDetail:()=>"Pilih nilai.",selectMultiple_apply:()=>"Gunakan",selectMultiple_back:()=>"Kembali",selectMultiple_countPlus:a=>a.COUNT+"+",selectMultiple_highlightSelectedTagsInstructionText:()=>"Use left and right arrow keys to highlight selected values.",selectMultiple_removeSelectedTagInstructionText:()=>"Tekan Backspace atau Delete untuk mengalih keluar nilai yang dipilih.",selectMultiple_selectedValues:()=>"Nilai yang dipilih",selectMultiple_showSelectedValues:()=>"Tunjukkan nilai yang dipilih sahaja.",selectMultiple_valuesSelected:a=>a.VALUE_COUNT+" nilai dipilih.",select_addToList:()=>"Tambah pada senarai",select_addToListAvailable:()=>"Tambah pada senarai tersedia",select_moreSearchOptions:()=>"Lebih banyak opsyen carian",select_moreSearchOptionsAvailable:()=>"Lebih banyak opsyen carian tersedia",select_noMatchesFound:()=>"Tiada padanan ditemui.",select_oneMatchFound:()=>"Satu padanan ditemui",select_requiredMessageDetail:()=>"Pilih nilai.",select_sizeMatchesFound:a=>a.TOTAL_SIZE+" padanan ditemukan",select_sizeOrMoreMatchesFound:a=>a.TOTAL_SIZE+" atau lebih padanan ditemukan",selectorAll_deselectAll:()=>"Deselect all",selectorAll_selectAll:()=>"Select all",selector_selected:()=>"Kotak semak ditanda",selector_unselected:()=>"Kotak semak tidak ditanda",tabBarNavigationList_removeCueText:()=>"Boleh dialih keluar",timeComponent_tooltipZoomIn:()=>"Zum Masuk",timeComponent_tooltipZoomOut:()=>"Zum Keluar",train_current:()=>"Semasa",train_message_type:()=>"Jenis Mesej",train_not_visited:()=>"Tidak dilawati",train_status:a=>"Langkah "+a.currentStep+" daripada "+a.numberOfSteps,train_visited:()=>"Dilawati",userAssistance_learnMore:()=>"Ketahui lebih lanjut",userAssistance_required:()=>"Diperlukan",viz_drillable:()=>"Boleh Dalami",warn:()=>"Amaran"};a.default=e,Object.defineProperty(a,"__esModule",{value:!0})}));
//# sourceMappingURL=bundle.js.map
