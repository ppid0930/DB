define(['exports'], (function(e){"use strict";const t={calendarDateConverter_parseError:e=>"Enter a complete date like this: "+e.dateExample+".",calendarMonthConverter_parseError:e=>"Enter a month and year like this: "+e.dateExample+".",chart_labelGroup:()=>"Nhóm",chart_labelSeries:()=>"Chuỗi",chart_labelValue:()=>"Giá trị",checkboxSet_requiredMessageDetail:()=>"Bắt buộc",checkbox_requiredMessageDetail:()=>"Bắt buộc",close:()=>"Đóng",collection_noData:()=>"Không có dữ liệu để hiển thị.",collection_selectAllRows:()=>"Chọn toàn bộ các hàng",collection_selectRow:e=>"Chọn hàng "+e.ROW_NAME,collection_sortDisabled:()=>"Không thể sắp xếp",collection_sortEnabled:()=>"Có thể sắp xếp",confirmation:()=>"Xác nhận",dataVisualization_labelAndValue:e=>e.LABEL+": "+e.VALUE,dataVisualization_labelCountWithTotal:e=>e.itemCount+"/"+e.totalCount,dataVisualization_noData:()=>"Không có dữ liệu để hiển thị",dataVisualization_stateSelected:()=>"Được chọn",dataVisualization_stateUnselected:()=>"Không được chọn",error:()=>"Lỗi",expandableList_expandCollapseInstructionText:()=>"Sử dụng các phím mũi tên để mở rộng và thu gọn",expandableList_groupCollapse:()=>"Đã thu gọn",expandableList_groupExpand:()=>"Đã mở rộng",filePicker_addFiles:()=>"Thêm tập tin",filePicker_dropzonePrimaryText:()=>"Kéo và thả",filePicker_dropzoneSecondaryText:()=>"Chọn tập tin hoặc thả một tập tin vào đây",filePicker_dropzoneSecondaryTextMultiple:()=>"Chọn hoặc thả tập tin ở đây",filePicker_multipleFileTypeUploadError:e=>"Bạn không thể tải lên tập tin loại: "+e.fileTypes,filePicker_singleFileUploadError:()=>"Tải lên một tập tin tại một thời điểm",filePicker_singleTypeUploadError:e=>"Bạn không thể tải lên tập tin loại "+e.fileType,filePicker_unknownFileTypeUploadError:()=>"không xác định",formControl_clear:()=>"Xóa",formControl_day:()=>"Ngày",formControl_helpAvailable:()=>"Có sẵn trợ giúp",formControl_limitReached:e=>"Bạn đã đạt đến giới hạn "+({one:"1 character"}[new Intl.PluralRules("vi").select(e.CHARACTER_LIMIT)]||new Intl.NumberFormat("vi").format(e.CHARACTER_LIMIT)+" characters")+".",formControl_loading:()=>"Đang tải",formControl_maxLengthExceeded:e=>"Đã vượt quá độ dài tối đa "+e.MAX_LENGTH+".",formControl_maxLengthRemaining:e=>"Còn lại "+e.CHARACTER_COUNT+" ký tự.",formControl_month:()=>"Tháng",formControl_readOnly:()=>"Chỉ đọc",formControl_requiredMessageDetail:()=>"Nhập giá trị.",formControl_year:()=>"Năm",gantt_labelDate:()=>"Ngày",gantt_labelEnd:()=>"Kết thúc",gantt_labelLabel:()=>"Nhãn",gantt_labelRow:()=>"Hàng",gantt_labelStart:()=>"Bắt đầu",indexer_disabledLabel:e=>e.SECTION+". Không tìm thấy phần nào phù hợp.",indexer_keyboardInstructionText:()=>"Nhấn enter để chọn giá trị.",indexer_othersLabel:()=>"#",indexer_separatorLabel:e=>"Từ "+e.FROM_SECTION+" đến "+e.TO_SECTION+".",indexer_touchInstructionText:()=>"Chạm hai lần và giữ để truy cập chế độ cử chỉ, rồi kéo lên hoặc xuống để điều chỉnh giá trị.",info:()=>"Thông tin",inputDateMask_date_cleared:()=>"Ngày xóa",inputDateMask_dayPlaceholder:()=>"dd",inputDateMask_empty_segment:()=>"Trống",inputDateMask_monthPlaceholder:()=>"mm",inputDateMask_yearPlaceholder:()=>"yyyy",inputMonthMask_dateRangeOverflowMessageDetail:e=>"Enter a month and year that's on or before "+e.max+".",inputMonthMask_dateRangeUnderflowMessageDetail:e=>"Enter a month and year that's on or after "+e.min+".",inputNumber_converterParseError:()=>"Nhập một số.",inputNumber_decrease:()=>"Giảm",inputNumber_increase:()=>"Tăng",inputPassword_hidden:()=>"Mật khẩu bị ẩn",inputPassword_hide:()=>"Ẩn mật khẩu",inputPassword_show:()=>"Hiển thị mật khẩu",inputSensitiveText_hidden:()=>"Sensitive text hidden",list_suggestion:()=>"Gợi ý",messageToast_allMessagesClosed:()=>"Tất cả thông báo bật lên đều được đóng.",message_close:()=>"Đóng",message_confirmation:()=>"Thành công",message_error:()=>"Lỗi",message_info:()=>"Thông tin",message_navigationFromMessagesRegion:()=>"Truy cập khu vực thông báo. Nhấn F6 để chuyển trở lại yếu tố được làm nổi bật trước.",message_navigationToMessagesRegion:()=>"Có thông báo mới ở khu vực thông báo. Hãy nhấn F6 để chuyển đến khu vực thông báo gần đây nhất.",message_warning:()=>"Cảnh báo",noData_message:()=>"Không có mục nào để hiển thị",overflowItemLabel:()=>"Thêm tab",plural_separator:()=>", ",progressIndeterminate:()=>"Đang xử lý",radio_helpForRadio:()=>"Trợ giúp cho nút radio",radio_requiredMessageDetail:()=>"Chọn một giá trị.",selectMultiple_apply:()=>"Áp dụng",selectMultiple_back:()=>"Trở lại",selectMultiple_countPlus:e=>e.COUNT+"+",selectMultiple_highlightSelectedTagsInstructionText:()=>"Use left and right arrow keys to highlight selected values.",selectMultiple_removeSelectedTagInstructionText:()=>"Nhấn phím Backspace hoặc Delete để xóa giá trị đã chọn.",selectMultiple_selectedValues:()=>"Giá trị đã chọn",selectMultiple_showSelectedValues:()=>"Chỉ hiển thị các giá trị đã chọn.",selectMultiple_valuesSelected:e=>"Đã chọn "+e.VALUE_COUNT+" giá trị.",select_addToList:()=>"Thêm vào danh sách",select_addToListAvailable:()=>"Có sẵn nút thêm vào danh sách",select_moreSearchOptions:()=>"Các tùy chọn tìm kiếm khác",select_moreSearchOptionsAvailable:()=>"Có sẵn các tùy chọn tìm kiếm khác",select_noMatchesFound:()=>"Không tìm thấy kết quả khớp nào.",select_oneMatchFound:()=>"Tìm thấy một kết quả khớp",select_requiredMessageDetail:()=>"Chọn một giá trị.",select_sizeMatchesFound:e=>"Tìm thấy "+e.TOTAL_SIZE+" kết quả phù hợp",select_sizeOrMoreMatchesFound:e=>"Tìm thấy "+e.TOTAL_SIZE+" kết quả phù hợp trở lên",selectorAll_deselectAll:()=>"Deselect all",selectorAll_selectAll:()=>"Select all",selector_selected:()=>"Đã đánh dấu vào hộp chọn",selector_unselected:()=>"Chưa đánh dấu vào hộp chọn",tabBarNavigationList_removeCueText:()=>"Có thể xóa",timeComponent_tooltipZoomIn:()=>"Phóng to",timeComponent_tooltipZoomOut:()=>"Thu nhỏ",train_current:()=>"Hiện tại",train_message_type:()=>"Loại thông báo",train_not_visited:()=>"Chưa truy cập",train_status:e=>"Bước "+e.currentStep+"/"+e.numberOfSteps,train_visited:()=>"Đã truy cập",userAssistance_learnMore:()=>"Tìm hiểu thêm",userAssistance_required:()=>"Bắt buộc",viz_drillable:()=>"Có thể xem chi tiết",warn:()=>"Cảnh báo"};e.default=t,Object.defineProperty(e,"__esModule",{value:!0})}));
//# sourceMappingURL=bundle.js.map