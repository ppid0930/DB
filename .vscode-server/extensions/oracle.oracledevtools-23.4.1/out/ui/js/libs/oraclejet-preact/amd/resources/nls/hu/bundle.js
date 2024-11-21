define(['exports'], (function(e){"use strict";const t={calendarDateConverter_parseError:e=>"Enter a complete date like this: "+e.dateExample+".",calendarMonthConverter_parseError:e=>"Enter a month and year like this: "+e.dateExample+".",chart_labelGroup:()=>"Csoport",chart_labelSeries:()=>"Sorozat",chart_labelValue:()=>"Érték",checkboxSet_requiredMessageDetail:()=>"Kötelező",checkbox_requiredMessageDetail:()=>"Kötelező",close:()=>"Bezárás",collection_noData:()=>"Nincs megjeleníthető adat.",collection_selectAllRows:()=>"Minden sor kijelölése",collection_selectRow:e=>e.ROW_NAME+". sor kijelölése",collection_sortDisabled:()=>"Nem rendezhető",collection_sortEnabled:()=>"Rendezhető",confirmation:()=>"Megerősítés",dataVisualization_labelAndValue:e=>e.LABEL+": "+e.VALUE,dataVisualization_labelCountWithTotal:e=>e.totalCount+"/"+e.itemCount,dataVisualization_noData:()=>"Nincs megjeleníthető adat",dataVisualization_stateSelected:()=>"Kijelölt",dataVisualization_stateUnselected:()=>"Nem kijelölt",error:()=>"Hiba",expandableList_expandCollapseInstructionText:()=>"A kibontáshoz és összecsukáshoz használja a nyílbillentyűket",expandableList_groupCollapse:()=>"Összecsukott",expandableList_groupExpand:()=>"Kibontott",filePicker_addFiles:()=>"Fájlok hozzáadása",filePicker_dropzonePrimaryText:()=>"Áthelyezés húzással",filePicker_dropzoneSecondaryText:()=>"Válassza ki a fájlt, vagy húzza át ide",filePicker_dropzoneSecondaryTextMultiple:()=>"Válassza ki a fájlokat, vagy húzza át ide",filePicker_multipleFileTypeUploadError:e=>"Nem tölthet fel "+e.fileTypes+" típusú fájlt",filePicker_singleFileUploadError:()=>"Egyszerre csak egy fájlt töltsön fel",filePicker_singleTypeUploadError:e=>"Nem tölthet fel "+e.fileType+" típusú fájlt",filePicker_unknownFileTypeUploadError:()=>"ismeretlen",formControl_clear:()=>"Törlés",formControl_day:()=>"Nap",formControl_helpAvailable:()=>"Elérhető súgó",formControl_limitReached:e=>"Elérte a(z) "+({one:new Intl.NumberFormat("hu").format(e.CHARACTER_LIMIT)+" karakteres"}[new Intl.PluralRules("hu").select(e.CHARACTER_LIMIT)]||new Intl.NumberFormat("hu").format(e.CHARACTER_LIMIT)+" karakteres")+" korlátot.",formControl_loading:()=>"Betöltés",formControl_maxLengthExceeded:e=>"Túllépte a maximális hosszt: "+e.MAX_LENGTH+".",formControl_maxLengthRemaining:e=>e.CHARACTER_COUNT+" karakter maradt.",formControl_month:()=>"Hónap",formControl_readOnly:()=>"Írásvédett",formControl_requiredMessageDetail:()=>"Adjon meg egy értéket.",formControl_year:()=>"Év",gantt_labelDate:()=>"Dátum",gantt_labelEnd:()=>"Befejezés",gantt_labelLabel:()=>"Címke",gantt_labelRow:()=>"Sor",gantt_labelStart:()=>"Kezdés",indexer_disabledLabel:e=>e.SECTION+". Nem található egyező szakasz.",indexer_keyboardInstructionText:()=>"Az érték kiválasztásához nyomja meg az Enter billentyűt.",indexer_othersLabel:()=>"#",indexer_separatorLabel:e=>e.FROM_SECTION+" és "+e.TO_SECTION+" között.",indexer_touchInstructionText:()=>"A gesztus módba belépéshez dupla koppintás és megtartás, majd lefelé vagy felfelé húzás az érték beállításához.",info:()=>"Információ",inputDateMask_date_cleared:()=>"Törlés dátuma",inputDateMask_dayPlaceholder:()=>"nn",inputDateMask_empty_segment:()=>"Üres",inputDateMask_monthPlaceholder:()=>"hh",inputDateMask_yearPlaceholder:()=>"éééé",inputMonthMask_dateRangeOverflowMessageDetail:e=>"Enter a month and year that's on or before "+e.max+".",inputMonthMask_dateRangeUnderflowMessageDetail:e=>"Enter a month and year that's on or after "+e.min+".",inputNumber_converterParseError:()=>"Adjon meg egy számot.",inputNumber_decrease:()=>"Csökkentés",inputNumber_increase:()=>"Növelés",inputPassword_hidden:()=>"Jelszó elrejtve",inputPassword_hide:()=>"Jelszó elrejtése",inputPassword_show:()=>"Jelszó megjelenítése",inputSensitiveText_hidden:()=>"Sensitive text hidden",list_suggestion:()=>"Javaslat",messageToast_allMessagesClosed:()=>"Az összes információs üzenet bezárva.",message_close:()=>"Bezárás",message_confirmation:()=>"Siker",message_error:()=>"Hiba",message_info:()=>"Információ",message_navigationFromMessagesRegion:()=>"Belépés az üzenetek régióba. Az F6 billentyűvel léphet a korábban kijelölt elemhez.",message_navigationToMessagesRegion:()=>"Az üzenetek régióban új üzenetek találhatók. Az F6 billentyűvel léphet a legutóbbi üzenetrégióhoz.",message_warning:()=>"Figyelmeztetés",noData_message:()=>"Nincs megjeleníthető elem",overflowItemLabel:()=>"További lapok",plural_separator:()=>", ",progressIndeterminate:()=>"Folyamatban",radio_helpForRadio:()=>"Súgó választógombhoz",radio_requiredMessageDetail:()=>"Jelöljön ki egy értéket.",selectMultiple_apply:()=>"Alkalmaz",selectMultiple_back:()=>"Vissza",selectMultiple_countPlus:e=>e.COUNT+"+",selectMultiple_highlightSelectedTagsInstructionText:()=>"Use left and right arrow keys to highlight selected values.",selectMultiple_removeSelectedTagInstructionText:()=>"A kijelölt érték eltávolításához nyomja meg a Backspace vagy a Delete billentyűt.",selectMultiple_selectedValues:()=>"Kiválasztott értékek",selectMultiple_showSelectedValues:()=>"Csak a kijelölt értékek megjelenítése.",selectMultiple_valuesSelected:e=>e.VALUE_COUNT+" kiválasztott érték.",select_addToList:()=>"Hozzáadás listához",select_addToListAvailable:()=>"Hozzáadás listához elérhető",select_moreSearchOptions:()=>"További keresési beállítások",select_moreSearchOptionsAvailable:()=>"További keresési beállítások elérhetők",select_noMatchesFound:()=>"Nincs találat.",select_oneMatchFound:()=>"Egy egyezés található",select_requiredMessageDetail:()=>"Jelöljön ki egy értéket.",select_sizeMatchesFound:e=>e.TOTAL_SIZE+" egyezés található",select_sizeOrMoreMatchesFound:e=>e.TOTAL_SIZE+" vagy több egyezés található",selectorAll_deselectAll:()=>"Összes kijelölés törlése",selectorAll_selectAll:()=>"Mindent kijelöl",selector_selected:()=>"Jelölőnégyzet bejelölve",selector_unselected:()=>"Jelölőnégyzet nincs bejelölve",tabBarNavigationList_removeCueText:()=>"Eltávolítható",timeComponent_tooltipZoomIn:()=>"Nagyítás",timeComponent_tooltipZoomOut:()=>"Kicsinyítés",train_current:()=>"Aktuális",train_message_type:()=>"Üzenet típusa",train_not_visited:()=>"Nem látogatott",train_status:e=>e.numberOfSteps+"/"+e.currentStep+". lépés",train_visited:()=>"Látogatott",userAssistance_learnMore:()=>"További tudnivalók",userAssistance_required:()=>"Kötelező",viz_drillable:()=>"Részletezhető",warn:()=>"Figyelmeztetés"};e.default=t,Object.defineProperty(e,"__esModule",{value:!0})}));
//# sourceMappingURL=bundle.js.map
