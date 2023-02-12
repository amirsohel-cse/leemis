@extends('frontend.master.help_master')


@section('content')

<link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

    <style>

        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap");

        /*.accordion-content {*/
        /*    max-width: 570px;*/
        /*    margin: 0 auto;*/
        /*    padding: 2rem;*/
        /*    background: #fff;*/
        /*    box-shadow: 0px 4px 16px rgba(0, 0, 0, 0.09);*/
        /*    border-radius: 8px;*/
        /*}*/

        .accordion-item {
            display: flex;
            flex-direction: column;
            padding: 13px;
            border-radius: 5px;
            border: 1px solid #ddd;
            box-shadow: 0px 4px 16px rgba(0, 0, 0, 0.09);
            cursor: pointer;
            background: #fff;
            margin-bottom: 0.5em;
        }

        .item-header {
            display: flex;
            justify-content: space-between;
            column-gap: 0.2em;
            align-items: center;
        }

        .item-icon {
            flex: 0 0 25px;
            display: grid;
            place-items: center;
            font-size: 1.25rem;
            height: 25px;
            width: 25px;
            border-radius: 4px;
            background: #dedede;
            cursor: pointer;
            box-shadow: 0px 4px 16px rgba(0, 0, 0, 0.09);
        }

        .item-icon i {
            transition: all 0.25s cubic-bezier(0.5, 0, 0.1, 1);
        }

        .item-question {
            font-size: 1em;
            line-height: 1;
            font-weight: 500;
            margin-bottom: 0;
            font-size: 18px;
        }

        .active .item-icon i {
            transform: rotate(180deg);
        }

        .active .item-question {
            font-weight: 500;
        }

        .item-content {
            max-height: 0;
            overflow: hidden;
            transition: all 300ms ease;
        }

        .item-answer {
            line-height: 150%;
            opacity: 1;
            margin-bottom: 0;
            margin-top: 20px;
        }

    </style>

    <div class="container py-5">
        <div class="row">
            <div class="accordion-content">
                <h2>{{$category->name}}</h2>

                @forelse ($category->articals as $artical)
                    
                    <div class="accordion-item">
                        <header class="item-header">
                            <h4 class="item-question">
                                {{$artical->title}}
                            </h4>
                            <div class="item-icon">
                                <i class='bx bx-chevron-down'></i>
                            </div>
                        </header>
                        <div class="item-content">
                            <p class="item-answer">
                                {{$artical->description}}
                            </p>
                            
                        </div>
                    </div>
                @empty

                    <div class="accordion-item">
                        <p>No Articles Found</p>
                    </div>

                @endforelse
               
            </div>
        </div>
    </div>



@endsection
@push('script')

<script>
    const accordionBtns = document.querySelectorAll(".item-header");

    accordionBtns.forEach((accordion) => {
        accordion.onclick = function() {
            this.classList.toggle("active");
            let content = this.nextElementSibling;
            if (content.style.maxHeight) {
                content.style.maxHeight = null;
            } else {
                content.style.maxHeight = content.scrollHeight + "px";
            }
        };
    });
</script>
    
@endpush