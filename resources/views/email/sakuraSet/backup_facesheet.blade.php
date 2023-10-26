<div>
    <p>構成員番号: {{ $config['sakuraData']->made_member->login_id }}</p>
    <p>{{ $config['sakuraData']->made_member->name1.' '.$config['sakuraData']->made_member->name2 }} 様</p>
    <p>生涯研修制度「私の研鑽データ（研鑽管理システム）」よりお知らせです。</p>
    <p>{{ $config['sakuraData']->reviewer_member->name1.' '.$config['sakuraData']->reviewer_member->name2 }} 様（構成員番号{{ $config['sakuraData']->reviewer_member->login_id }}）が フェイスシートの修正がありました。</p>
    <p>以下の＜ご確認の流れ＞を参考に、ご確認のほど宜しくお願い申しあげます。</p>
    <p>＜ご確認の流れ＞</p>
    <p>構成員マイページにログイン→「私の研鑽データ」にアクセス→「自己研鑽支援ツール『さくらセット』に取り組む」を確認    </p>
@include('email.sakuraSet.emailTemplateFooter')
</div>
