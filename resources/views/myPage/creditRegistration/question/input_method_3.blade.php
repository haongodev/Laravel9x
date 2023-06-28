<div
    class="input-group after-question-id-{{$questionSetting->id}} before-question-id-{{$questionSetting->parent_question_option_id}}">
    <div class="w-100 group-control">
        <label for="email" class="w-25">研鑽目的</label>
        <div class="w-75 table-group">
            <table>
                {{-- 1 --}}
                <tr>
                    <th class="bg-red" rowspan="2">1 仕事と暮らしの調和</th>
                    <td><input type="checkbox" name="study_purpose[]" value="1" id="checkbox1"> <label
                            for="checkbox1">(1)健康状態の自己管理</label></td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="study_purpose[]" value="2" id="checkbox2"> <label
                            for="checkbox2">(2)仕事と家庭のバランス</label></td>
                </tr>
                {{-- 2 --}}
                <tr>
                    <th rowspan="2">2 社会人・組織人としての力</th>
                    <td><input type="checkbox" name="SAAMOS[]" value="3" id="checkbox3"> <label
                            for="checkbox3">(1)基本姿勢やマナー</label></td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="SAAMOS[]" value="4" id="checkbox4"> <label
                            for="checkbox4">(2)組織人としての役割遂行</label></td>
                </tr>
                {{-- 3 --}}
                <tr>
                    <th rowspan="5">3 専門職・実践者としての力</th>
                    <td><input type="checkbox" name="PAAP[]" value="5" id="checkbox5"> <label
                            for="checkbox5">(1)専門的支援関係形成力（個人、小集団、地域等）</label></td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="PAAP[]" value="6" id="checkbox6"> <label
                            for="checkbox6">(2)アセスメント力</label></td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="PAAP[]" value="7" id="checkbox7"> <label
                            for="checkbox7">(3)支援・介入・調整力</label></td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="PAAP[]" value="8" id="checkbox8"> <label
                            for="checkbox8">(4)連携・協働・チーム形成力<</label>/td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="PAAP[]" value="9" id="checkbox9"> <label
                            for="checkbox9">(5)コミュニティへのアプローチ・ソーシャルアクションの力</label></td>
                </tr>
                {{-- 4 --}}
                <tr>
                    <th>4 自己研鑽</th>
                    <td><input type="checkbox" name="brainstorming[]" value="10" id="checkbox10"> <label
                            for="checkbox10">(1)専門性を養うために学び続ける力</label></td>
                </tr>
                {{-- 5 --}}
                <tr>
                    <th rowspan="2">5 専門職教育・研究</th>
                    <td><input type="checkbox" name="PEAR[]" value="11" id="checkbox11"> <label
                            for="checkbox11">(1)ソーシャルワーカーを育てる力</label></td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="PEAR[]" value="12" id="checkbox12"> <label
                            for="checkbox12">(2)研究、実践成果を示す力</label></td>
                </tr>
                <tr>
                    <th>6 ソーシャルワーカー意識</th>
                    <td><input type="checkbox" name="SWA[]" value="13" id="checkbox13"> <label
                            for="checkbox13">(1)ソーシャルワーカーアイデンティティ・モチベーションを維持する力</label></td>
                </tr>
            </table>
        </div>
    </div>
</div>

