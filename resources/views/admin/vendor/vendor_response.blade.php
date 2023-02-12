
            @forelse($vendors as $key => $row)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->email }}
                        <input type="hidden" name="email" value="{{ $row->email }}">
                    </td>
                    <td>{{ $row->phone }}</td>
                    <td>{{ $row->shop_name }}</td>
                    <td>{{ $row->address }}</td>
                    <td>{{ $row->created_at->format('d-m-Y') }}</td>
                    <td>
                        <span data-id="{{ $row->id }}"
                            class="badge {{ $row->feature == 1 ? 'badge-success' : 'badge-danger' }} yesNo"
                            style="cursor: pointer">{{ $row->feature == 1 ? 'YES' : 'NO' }}</span>


                    </td>
                    <td>
                        <span data-id="{{ $row->id }}"
                            class="badge {{ $row->s_status == 1 ? 'badge-success' : 'badge-danger' }} selectStatus"
                            style="cursor: pointer">{{ $row->s_status == 1 ? 'ACTIVE' : 'DEACTIVE' }}</span>

                    </td>

                    <td>
                        <button data-id="{{ $row->id }}" data-toggle="modal"
                            data-target="#editVendorModal"
                            class="btn btn-primary btn-round mr-1 editBtn" style="cursor: pointer"
                            type="button"><i class="fa fa-edit"></i> Edit</button>

                        <button data-id="{{ $row->id }}" data-toggle="modal" id="email"
                            data-target="#emailModal" class="btn btn-warning btn-round mr-1 editBtn"
                            style="cursor: pointer" type="button"><i class="fa fa-edit"></i>
                            Email</button>



                    </td>
                @empty
                    <td colspan="5" class="text-center">No data Available</td>
                </tr>
            @endforelse


