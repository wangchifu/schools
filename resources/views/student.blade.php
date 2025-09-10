@extends('layouts.app')

@section('title','首頁')

@section('content')
<style>
.table-hover tbody tr:hover {background-color: rgba(30, 144, 255, 0.2); /* 淡藍透明 */}
</style>
<section class="py-1">
    <div class="px-4 px-lg-5">
        資料更新：{{ $data_time }} <a href="{{ route('refresh') }}" class="btn btn-primary btn-sm">手動更新</a>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="{{ route('index') }}">學校</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('teacher_select') }}">教職員</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('student_select') }}">學生數統計</a>
            </li>
        </ul>
        <div class="d-flex">
            <select class="form-select my-2" style="width:200px;" name="area" id="area">
                <option value="all" {{ $area == "all" ? 'selected' : '' }}>全部鄉鎮市</option>
                @foreach($area_array as $k=>$v)
                    <option value="{{ $k }}" {{ $k == $area ? 'selected' : '' }}>{{ $k }}</option>            
                @endforeach
            </select>
            <select class="form-select my-2" style="width:200px;" name="school_type" id="school_type">
                <option value="all" {{ $school_type == "all" ? 'selected' : '' }}>全部</option>
                <option value="國民小學" {{ $school_type=="國民小學" ? 'selected' : '' }}>國小</option>
                <option value="國民中學" {{ $school_type=="國民中學" ? 'selected' : '' }}>國中</option>
            </select>
        </div>
        <div class="table-responsive">            
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th rowspan="2">#</th>
                        <th rowspan="2" nowrap>鄉鎮市</th>
                        <th rowspan="2" nowrap>學校名稱</th>  
                        <th colspan="3" class="bg-light" style="text-align: center;" nowrap>總數</th>                                          
                        <th colspan="3" style="text-align: center;background-color: rgba(255, 165, 0, 0.6);" nowrap>一年級</th>
                        <th colspan="3" style="text-align: center;background-color: rgba(30, 144, 255, 0.6);" nowrap>二年級</th>
                        <th colspan="3" style="text-align: center;background-color: rgba(255, 165, 0, 0.6);" nowrap>三年級</th>
                        <th colspan="3" style="text-align: center;background-color: rgba(30, 144, 255, 0.6);" nowrap>四年級</th>
                        <th colspan="3" style="text-align: center;background-color: rgba(255, 165, 0, 0.6);" nowrap>五年級</th>
                        <th colspan="3" style="text-align: center;background-color: rgba(30, 144, 255, 0.6);" nowrap>六年級</th>
                        <th colspan="3" style="text-align: center;background-color: rgba(255, 165, 0, 0.6);" nowrap>特教班</th>
                    </tr>
                    <tr>
                        <th class="bg-light" nowrap>全校</th>
                        <th class="bg-light" nowrap>男生</th>
                        <th class="bg-light" nowrap>女生</th>
                        <th style="background-color: rgba(255, 165, 0, 0.6);" nowrap>班級數</th>
                        <th style="background-color: rgba(255, 165, 0, 0.6);" >男</th>
                        <th style="background-color: rgba(255, 165, 0, 0.6);" >女</th>
                        <th style="background-color: rgba(30, 144, 255, 0.6);" nowrap>班級數</th>
                        <th style="background-color: rgba(30, 144, 255, 0.6);" >男</th>
                        <th style="background-color: rgba(30, 144, 255, 0.6);" >女</th>
                        <th style="background-color: rgba(255, 165, 0, 0.6);"  nowrap>班級數</th>
                        <th style="background-color: rgba(255, 165, 0, 0.6);" >男</th>
                        <th style="background-color: rgba(255, 165, 0, 0.6);" >女</th>
                        <th style="background-color: rgba(30, 144, 255, 0.6);"  nowrap>班級數</th>
                        <th style="background-color: rgba(30, 144, 255, 0.6);" >男</th>
                        <th style="background-color: rgba(30, 144, 255, 0.6);" >女</th>
                        <th style="background-color: rgba(255, 165, 0, 0.6);"  nowrap>班級數</th>
                        <th style="background-color: rgba(255, 165, 0, 0.6);" >男</th>
                        <th style="background-color: rgba(255, 165, 0, 0.6);" >女</th>
                        <th style="background-color: rgba(30, 144, 255, 0.6);"  nowrap>班級數</th>
                        <th style="background-color: rgba(30, 144, 255, 0.6);" >男</th>
                        <th style="background-color: rgba(30, 144, 255, 0.6);" >女</th>
                        <th style="background-color: rgba(255, 165, 0, 0.6);"  nowrap>班級數</th>
                        <th style="background-color: rgba(255, 165, 0, 0.6);" >男</th>
                        <th style="background-color: rgba(255, 165, 0, 0.6);" >女</th>
                    </tr>
                </thead>
                <tbody id="school_list">
                    <?php $n=0; ?>
                    @foreach($area_array as $k1=>$v1)
                        @foreach($school_data[$k1] as $k2=>$v2)
                            @foreach($v2 as $k3=>$v3)
                            <?php
                                if($area != 'all'){
                                    if($k1 != $area) break;
                                }
                                if($school_type != 'all'){                                
                                    if($k2 != $school_type) break;                                
                                }
                                $n++; 
                            ?>
                                <tr>
                                    <td>{{ $n }}</td>
                                    <td>{{ $k1 }}</td>
                                    <td nowrap>{{ $v3['schoolName'] }}</td>                                
                                    <td>{{ $v3['totalNum'] }}</td>
                                    <td>{{ $v3['boyNum'] }}</td>
                                    <td>{{ $v3['girlNum'] }}</td>                                    
                                    <td>
                                        @if($k2=="國民小學")
                                            @if(isset($details[$k3][1]))                                                
                                                {{ $details[$k3][1]['total_class'] }}
                                            @endif
                                        @endif
                                        @if($k2=="國民中學")
                                            @if(isset($details[$k3][7]))
                                                {{ $details[$k3][7]['total_class'] }}
                                            @endif
                                        @endif                                        
                                    </td>
                                    <td>
                                        @if($k2=="國民小學")
                                            @if(isset($details[$k3][1]))                                                
                                            {{ $details[$k3][1]['boy'] }}
                                            @endif
                                        @endif
                                        @if($k2=="國民中學")
                                            @if(isset($details[$k3][7]))                                                
                                            {{ $details[$k3][7]['boy'] }}
                                            @endif
                                        @endif
                                    </td>                                    
                                    <td>
                                        @if($k2=="國民小學")
                                            @if(isset($details[$k3][1]))                                                
                                            {{ $details[$k3][1]['girl'] }}
                                            @endif
                                        @endif
                                        @if($k2=="國民中學")
                                            @if(isset($details[$k3][7]))                                                
                                            {{ $details[$k3][7]['girl'] }}
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        @if($k2=="國民小學")
                                            @if(isset($details[$k3][2]))                                                
                                                {{ $details[$k3][2]['total_class'] }}
                                            @endif
                                        @endif
                                        @if($k2=="國民中學")
                                            @if(isset($details[$k3][8]))
                                                {{ $details[$k3][8]['total_class'] }}
                                            @endif
                                        @endif                                        
                                    </td>
                                    <td>
                                        @if($k2=="國民小學")
                                            @if(isset($details[$k3][2]))                                                
                                            {{ $details[$k3][2]['boy'] }}
                                            @endif
                                        @endif
                                        @if($k2=="國民中學")
                                            @if(isset($details[$k3][8]))                                                
                                            {{ $details[$k3][8]['boy'] }}
                                            @endif
                                        @endif
                                    </td>                                    
                                    <td>
                                        @if($k2=="國民小學")
                                            @if(isset($details[$k3][2]))                                                
                                            {{ $details[$k3][2]['girl'] }}
                                            @endif
                                        @endif
                                        @if($k2=="國民中學")
                                            @if(isset($details[$k3][8]))                                                
                                            {{ $details[$k3][8]['girl'] }}
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        @if($k2=="國民小學")
                                            @if(isset($details[$k3][3]))                                                
                                                {{ $details[$k3][3]['total_class'] }}
                                            @endif
                                        @endif
                                        @if($k2=="國民中學")
                                            @if(isset($details[$k3][9]))
                                                {{ $details[$k3][9]['total_class'] }}
                                            @endif
                                        @endif                                        
                                    </td>
                                    <td>
                                        @if($k2=="國民小學")
                                            @if(isset($details[$k3][3]))                                                
                                            {{ $details[$k3][3]['boy'] }}
                                            @endif
                                        @endif
                                        @if($k2=="國民中學")
                                            @if(isset($details[$k3][9]))                                                
                                            {{ $details[$k3][9]['boy'] }}
                                            @endif
                                        @endif
                                    </td>                                    
                                    <td>
                                        @if($k2=="國民小學")
                                            @if(isset($details[$k3][3]))                                                
                                            {{ $details[$k3][3]['girl'] }}
                                            @endif
                                        @endif
                                        @if($k2=="國民中學")
                                            @if(isset($details[$k3][9]))                                                
                                            {{ $details[$k3][9]['girl'] }}
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        @if($k2=="國民小學")
                                            @if(isset($details[$k3][4]))                                                
                                                {{ $details[$k3][4]['total_class'] }}
                                            @endif
                                        @endif                                                            
                                    </td>
                                    <td>
                                        @if($k2=="國民小學")
                                            @if(isset($details[$k3][4]))                                                
                                            {{ $details[$k3][4]['boy'] }}
                                            @endif
                                        @endif
                                    </td>                                    
                                    <td>
                                        @if($k2=="國民小學")
                                            @if(isset($details[$k3][4]))                                                
                                            {{ $details[$k3][4]['girl'] }}
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        @if($k2=="國民小學")
                                            @if(isset($details[$k3][5]))                                                
                                                {{ $details[$k3][5]['total_class'] }}
                                            @endif
                                        @endif                                                            
                                    </td>
                                    <td>
                                        @if($k2=="國民小學")
                                            @if(isset($details[$k3][5]))                                                
                                            {{ $details[$k3][5]['boy'] }}
                                            @endif
                                        @endif
                                    </td>                                    
                                    <td>
                                        @if($k2=="國民小學")
                                            @if(isset($details[$k3][5]))                                                
                                            {{ $details[$k3][5]['girl'] }}
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        @if($k2=="國民小學")
                                            @if(isset($details[$k3][6]))                                                
                                                {{ $details[$k3][6]['total_class'] }}
                                            @endif
                                        @endif                                                            
                                    </td>
                                    <td>
                                        @if($k2=="國民小學")
                                            @if(isset($details[$k3][6]))                                                
                                            {{ $details[$k3][6]['boy'] }}
                                            @endif
                                        @endif
                                    </td>                                    
                                    <td>
                                        @if($k2=="國民小學")
                                            @if(isset($details[$k3][6]))                                                
                                            {{ $details[$k3][6]['girl'] }}
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        @if(isset($details[$k3][99]))                                                
                                            {{ $details[$k3][99]['total_class'] }}
                                        @endif                                                       
                                    </td>
                                    <td>
                                        @if(isset($details[$k3][99]))                                                
                                            {{ $details[$k3][99]['boy'] }}
                                        @endif
                                    </td>                                    
                                    <td>
                                        @if(isset($details[$k3][99]))                                                
                                            {{ $details[$k3][99]['girl'] }}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    @endforeach                
                </tbody>
            </table>
        </div>        
    </div>    
</section>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const areaSelect = document.getElementById('area');
    const schooltypeSelect = document.getElementById('school_type');

    function redirect() {
        const area = areaSelect.value || '全部鄉鎮市';
        const school_type = schooltypeSelect.value || 'all';
        // 注意 encodeURIComponent，避免中文或特殊字元造成問題
        window.location.href = `{{ route('student_select') }}/${encodeURIComponent(area)}/${encodeURIComponent(school_type)}`;
    }

    areaSelect.addEventListener('change', redirect);
    schooltypeSelect.addEventListener('change', redirect);
});
</script>
@endsection