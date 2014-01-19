<?php
/**
 *
 */
class LoginCityAction extends CommonAction{
	public function city( $id='city_index', $record_id="" ) {
		if ( session( 'user_type' ) == 3 ) {
			switch ( $id ) {

				// -------- 国家首页 --------
			case 'city_index':
				layout( './Common/frame' );
				$this->display( './Public/html/Content/City/homepage/city_index.html' );
				break;

				// -------- 转移地图展示 侧边栏 --------
			case 'GIS_sidebar':
				layout( './Common/frame' );
				$this->display( './Public/html/Content/City/GIS/GIS_sidebar.html' );
				break;
			case 'GIS_set_route':
				$record = M( 'vehicle_gps_transport' )->select();
				$record_json = json_encode( $record );
		
				$tmp_content=$this->fetch( './Public/html/Content/City/GIS/set_route.html' );
				$this->ajaxReturn( "<script>page_json=$record_json</script>$tmp_content" );
				break;				
			case 'GIS_map_receiver':
			 	if($table=M("route_".I( 'post.gps_id' )))
			 	{
				 	$data["gps_id"]=I( 'post.gps_id' );
				 	$data["task_status"]=0;
				 	$data["route_status"]=0;
				 	$data["route_detail"]=I( 'post.route_detail' );
				 	$table->add($data);
				 	$this->show("succ");			 	
				}
				else
				{
					$this->show("fail");			
				}
				

				break;			
				// 百度地图AJAX请求传GPS数据
			case 'bmap_ajax':
				$GIS_data = M( 'gps_308033501795' )->field( 'bmap_longitude, bmap_latitude' )->where( 'longitude > 0' )->select();
				$this->ajaxReturn( $GIS_data, 'JSON' );
				break;
				/*	// 转移地图展示
			case 'transfer_display':
				$tmp_content=$this->fetch( './Public/html/Content/City/GIS/transfer_display.html' );
				$this->ajaxReturn( $tmp_content );
				break;*/
			
				// -------- 危废产生单位->侧边栏 --------
			case 'production_sidebar':
				layout( './Common/frame' );
				$this->display( './Public/html/Content/City/production/production_sidebar.html' );
				break;
				// 危废产生单位->企业基本信息->企业基本信息
			case 'production_basic_information':
				$tmp_content=$this->fetch( './Public/html/Content/City/production/production_basic_information.html' );
				$this->ajaxReturn( $tmp_content );
				break;
				// 危废产生单位->危险废物台账->危废产生月报统计
			case 'waste_account_monthly_statistics':
				$tmp_content=$this->fetch( './Public/html/Content/City/production/waste_account_monthly_statistics.html' );
				$this->ajaxReturn( $tmp_content );
				break;
				// 危废产生单位->RFID手持端->RFID手持端绑定
			case 'production_rfid_hand_equipment':
				$tmp_content=$this->fetch( './Public/html/Content/City/production/production_rfid_hand_equipment.html' );
				$this->ajaxReturn( $tmp_content );
				break;

				// -------- 危废运输单位->侧边栏 --------
			case 'transport_sidebar':
				layout( './Common/frame' );
				$this->display( './Public/html/Content/City/transport/transport_sidebar.html' );
				break;
				// 危废运输单位->企业基本信息->企业基本信息
			case 'transport_basic_information':
				$tmp_content=$this->fetch( './Public/html/Content/City/transport/transport_basic_information.html' );
				$this->ajaxReturn( $tmp_content );
				break;
				// 危废运输单位->运输车辆管理->运输车辆管理
			case 'transport_vehicle_management':
				$tmp_content=$this->fetch( './Public/html/Content/City/transport/transport_vehicle_management.html' );
				$this->ajaxReturn( $tmp_content );
				break;
				// 危废运输单位->GPS监控信息->GPS监控信息
			case 'transport_gps_monitor_information':
				$tmp_content=$this->fetch( './Public/html/Content/City/transport/transport_gps_monitor_information.html' );
				$this->ajaxReturn( $tmp_content );
				break;

				// -------- 危废处置单位->侧边栏 --------
			case 'disposal_sidebar':
				layout( './Common/frame' );
				$this->display( './Public/html/Content/City/disposal/disposal_sidebar.html' );
				break;
				// 危废处置单位->企业基本信息->企业基本信息
			case 'disposal_basic_information':
				$tmp_content=$this->fetch( './Public/html/Content/City/disposal/disposal_basic_information.html' );
				$this->ajaxReturn( $tmp_content );
				break;
				// 危废处置单位->危废接受台账->危废接受月报统计
			case 'waste_reception_account_monthly_statistics':
				$tmp_content=$this->fetch( './Public/html/Content/City/disposal/waste_reception_account_monthly_statistics.html' );
				$this->ajaxReturn( $tmp_content );
				break;
				// 危废处置单位->RFID手持端->RFID手持端绑定
			case 'disposal_rfid_hand_equipment':
				$tmp_content=$this->fetch( './Public/html/Content/City/disposal/disposal_rfid_hand_equipment.html' );
				$this->ajaxReturn( $tmp_content );
				break;

				// -------- 危废转移->侧边栏 --------
			case 'transfer_sidebar':
				layout( './Common/frame' );
				$this->display( './Public/html/Content/City/transfer/transfer_sidebar.html' );
				break;
				// 危废转移->转移备案管理->转移备案
			case 'transfer_record':
				$tmp_content=$this->fetch( './Public/html/Content/City/transfer/transfer_record.html' );
				$this->ajaxReturn( $tmp_content );
				break;
				// 危废转移->转移联单管理->生产单位转移联单
			case 'production_transfer_manifest':
				$tmp_content=$this->fetch( './Public/html/Content/City/transfer/production_transfer_manifest.html' );
				$this->ajaxReturn( $tmp_content );
				break;
				// 危废转移->转移联单管理->运输单位转移联单
			case 'transport_transfer_manifest':
				$tmp_content=$this->fetch( './Public/html/Content/City/transfer/transport_transfer_manifest.html' );
				$this->ajaxReturn( $tmp_content );
				break;
				// 危废转移->转移联单管理->接受单位转移联单
			case 'reception_transfer_manifest':
				$tmp_content=$this->fetch( './Public/html/Content/City/transfer/reception_transfer_manifest.html' );
				$this->ajaxReturn( $tmp_content );
				break;
				// 危废转移->统计分析->转移去向统计
			case 'transfer_direction_statistic':
				$tmp_content=$this->fetch( './Public/html/Content/City/transfer/transfer_direction_statistic.html' );
				$this->ajaxReturn( $tmp_content );
				break;
				// 危废转移->统计分析->转移联单统计
			case 'transfer_manifest_statistic':
				$tmp_content=$this->fetch( './Public/html/Content/City/transfer/transfer_manifest_statistic.html' );
				$this->ajaxReturn( $tmp_content );
				break;
				// 危废转移->统计分析->转移专题定制
			case 'transfer_topic_customize':
				$tmp_content=$this->fetch( './Public/html/Content/City/transfer/transfer_topic_customize.html' );
				$this->ajaxReturn( $tmp_content );
				break;

				// -------- 业务办理->侧边栏 --------
			case 'business_sidebar':
				layout( './Common/frame' );
				$this->display( './Public/html/Content/City/business/business_sidebar.html' );
				break;
				// 业务办理->待办业务->转移备案管理
			case 'transfer_record_management':
				$record = M( 'record' )->getField( 'record_id,record_code,record_date,record_status' );
				$record_json = json_encode( $record );

				$unit_name = M( 'production_unit' )->getField( 'production_unit_name' );
				$unit_json = json_encode( $unit_name );

				$tmp_content=$this->fetch( './Public/html/Content/City/business/transfer_record_management.html' );
				$tmp_content = "<script>record_json = $record_json; unit_json = $unit_json; </script> $tmp_content";
				$this->ajaxReturn( $tmp_content );
				break;
				// 业务办理->待办业务->转移备案管理->详细信息页
			case 'transfer_record_management_page':
				$record = M( 'record' )->where( array( 'record_id' =>$record_id ) )->find();
				$production_unit = M( 'production_unit' )->where( array( 'production_unit_id' => $record['production_unit_id'] ) )->find();
				$this->record = $record;
				$this->unit = $production_unit;

				$record_id_json = json_encode( $record_id );

				$tmp_content=$this->fetch( './Public/html/Content/City/business/transfer_record_management_page.html' );
				$tmp_content = "<script>record_id_json = $record_id_json; </script> $tmp_content";
				$this->ajaxReturn( $tmp_content );
				break;
				// 业务办理->待办业务->转移备案管理->审核
			case 'transfer_record_management_audit':
				$record_status = I( 'post.record_status' );
				$current_record_status = array(
					'record_id' => $record_id,
					'record_status' => $record_status,
				);
				M( 'record' )->save( $current_record_status );
				break;
				// 业务办理->待办业务->转移联单管理
			case 'transfer_manifest_management':
				$tmp_content=$this->fetch( './Public/html/Content/City/business/transfer_manifest_management.html' );
				$this->ajaxReturn( $tmp_content );
				break;
				// 业务办理->待办业务->企业用户管理
			case 'enterprise_user_management':
				$record = M( 'alluser' )->select();
				$record_json = json_encode( $record );
				$tmp_content=$this->fetch( './Public/html/Content/City/business/enterprise_user_management.html' );
				$tmp_content="<script>record_json=$record_json;</script>$tmp_content";
				$this->ajaxReturn( "$tmp_content");
				break;
			case 'enterprise_user_management_page_production':
				$production_unit = M( 'production_unit' )->where(array('user_id' => $record_id ))->find();				
				$this->formData = $production_unit;
				$tmp_content=$this->fetch( './Public/html/Content/City/business/enterprise_user_management_page_production.html' );
				$this->ajaxReturn( $tmp_content );
				break;
			case 'enterprise_user_management_page_transport':
				$transport_unit = M( 'transport_unit' )->where(array('user_id' => $record_id ))->find();				
				$this->formData = $transport_unit;
				$tmp_content=$this->fetch( './Public/html/Content/City/business/enterprise_user_management_page_transport.html' );
				$this->ajaxReturn( $tmp_content );
				break;
			case 'enterprise_user_management_page_reception':
				$reception_unit = M( 'reception_unit' )->where(array('user_id' => $record_id ))->find();				
				$this->formData = $reception_unit;
				$tmp_content=$this->fetch( './Public/html/Content/City/business/enterprise_user_management_page_reception.html' );

				$this->ajaxReturn( $tmp_content );
				break;
			case 'enterprise_user_management_ajaxpost':
			
				$munit=M( 'user' );		
				if(I( 'post.action' )=="lock")
				{	
					if(I( 'post.value' )=='0')
						$data['lock'] = '0';
					else
						$data['lock'] = '1';
					$munit->where(array('user_id' =>I('post.user_id')))->save($data);
					$this->show("lock_ok".I('post.user_id'));
				}
				else if(I( 'post.action' )=="verify")
				{
					if(I( 'post.value' )=='0')
						$data['is_verify'] = '0';
					else
						$data['is_verify'] = '1';
					
					$munit->where(array('user_id' =>I('post.user_id')))->save($data);
					$this->show("verify_ok".I('post.user_id'));
				}	
				
				else
				{
					$this->error("action_error");
				}
		
				break;
			
				// 业务办理->待办业务->企业信息管理
			case 'enterprise_information_management':

				$tmp_content=$this->fetch( './Public/html/Content/City/business/enterprise_information_management.html' );
				$this->ajaxReturn( $tmp_content );
				break;
				// 业务办理->业务查询->转移备案查询
			case 'transfer_record_query':
				$tmp_content=$this->fetch( './Public/html/Content/City/business/transfer_record_query.html' );
				$this->ajaxReturn( $tmp_content );
				break;
				// 业务办理->业务查询->转移联单查询
			case 'transfer_manifest_query':
				$tmp_content=$this->fetch( './Public/html/Content/City/business/transfer_manifest_query.html' );
				$this->ajaxReturn( $tmp_content );
				break;
				// 业务办理->业务查询->企业信息查询
			case 'enterprise_information_query':
				$tmp_content=$this->fetch( './Public/html/Content/City/business/enterprise_information_query.html' );
				$this->ajaxReturn( $tmp_content );
				break;
				// 业务办理->业务查询->用户信息查询
			case 'user_information_query':
				$tmp_content=$this->fetch( './Public/html/Content/City/business/user_information_query.html' );
				$this->ajaxReturn( $tmp_content );
				break;

				// -------- 系统管理->侧边栏 --------
			case 'system_sidebar':
				layout( './Common/frame' );
				$this->display( './Public/html/Content/City/system/system_sidebar.html' );
				break;
				// 系统管理->系统信息设置->管辖权限
			case 'jurisdiction':
				$tmp_content=$this->fetch( './Public/html/Content/City/system/jurisdiction.html' );
				$this->ajaxReturn( $tmp_content );
				break;
				// 系统管理->系统信息设置->区县代码
			case 'district_code':
				$tmp_content=$this->fetch( './Public/html/Content/City/system/district_code.html' );
				$this->ajaxReturn( $tmp_content );
				break;
				// 系统管理->系统信息设置->行业代码
			case 'trade_code':
				$tmp_content=$this->fetch( './Public/html/Content/City/system/trade_code.html' );
				$this->ajaxReturn( $tmp_content );
				break;
				// 系统管理->系统信息设置->企业规模
			case 'enterprise_scale':
				$tmp_content=$this->fetch( './Public/html/Content/City/system/enterprise_scale.html' );
				$this->ajaxReturn( $tmp_content );
				break;
				// 系统管理->系统信息设置->注册类型
			case 'register_type':
				$tmp_content=$this->fetch( './Public/html/Content/City/system/register_type.html' );
				$this->ajaxReturn( $tmp_content );
				break;
				// 系统管理->系统信息设置->废物代码
			case 'waste_code':
				$tmp_content=$this->fetch( './Public/html/Content/City/system/waste_code.html' );
				$this->ajaxReturn( $tmp_content );
				break;
				// 系统管理->系统信息设置->废物类别
			case 'waste_category':
				$tmp_content=$this->fetch( './Public/html/Content/City/system/waste_category.html' );
				$this->ajaxReturn( $tmp_content );
				break;
				// 系统管理->系统信息设置->废物形态
			case 'waste_form':
				$tmp_content=$this->fetch( './Public/html/Content/City/system/waste_form.html' );
				$this->ajaxReturn( $tmp_content );
				break;
				// 系统管理->系统信息设置->包装方式
			case 'package_method':
				$tmp_content=$this->fetch( './Public/html/Content/City/system/package_method.html' );
				$this->ajaxReturn( $tmp_content );
				break;
				// 系统管理->系统信息设置->危废处理方式
			case 'waste_disposal_method':
				$tmp_content=$this->fetch( './Public/html/Content/City/system/waste_disposal_method.html' );
				$this->ajaxReturn( $tmp_content );
				break;
				// 系统管理->系统信息设置->危废去向
			case 'waste_direction':
				$tmp_content=$this->fetch( './Public/html/Content/City/system/waste_direction.html' );
				$this->ajaxReturn( $tmp_content );
				break;
				// 系统管理->系统信息设置->运输方式
			case 'transport_method':
				$tmp_content=$this->fetch( './Public/html/Content/City/system/transport_method.html' );
				$this->ajaxReturn( $tmp_content );
				break;

			default:
				$this->error( '页面不存在' );
				break;
			}
		}else {
			$this->redirect( 'Home/Index/index' );
		}
	}

}

?>
