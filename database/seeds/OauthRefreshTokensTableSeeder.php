<?php

use Illuminate\Database\Seeder;

class OauthRefreshTokensTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('oauth_refresh_tokens')->delete();
        
        \DB::table('oauth_refresh_tokens')->insert(array (
            0 => 
            array (
                'id' => '00d8b073510972cafecaeadefe61e4f8eb0c2274c0f341323f3c68a0c2179f6da7e1f1f734d03cd5',
                'access_token_id' => '9b165f657913e8c074b476bb3af4319cc74f774c930a6eaec96af53eb6ef1af84331a1f86a1e1af9',
                'revoked' => 0,
                'expires_at' => '2020-10-30 21:31:11',
            ),
            1 => 
            array (
                'id' => '04053ffa4e5ae79d1934986f1d81a129bd3e09d3d0dbaec70af8113e9ee551e43839d0267da97b11',
                'access_token_id' => '90392af65189649a5da593c1c1e549c7d2c52768e22febeea0dfcbf940d397e7b9165a2f9dec2bc9',
                'revoked' => 0,
                'expires_at' => '2020-09-17 21:59:28',
            ),
            2 => 
            array (
                'id' => '156c4da18a2b21d544bd5c9650647320fe0a484a132cf576056dccbe4dc3eae137f70fe54fde46b8',
                'access_token_id' => 'eb4489d9c7eadb6208e780cf48f20d6b7a8494dab17f95adfd679603566068cf86760d01843674d5',
                'revoked' => 0,
                'expires_at' => '2020-12-01 21:38:52',
            ),
            3 => 
            array (
                'id' => '2d45b2f7f142b672f804ec3c8c45234754eff9b935b6e9b1189ab0abeb5eb1aa3b56174bac4954c3',
                'access_token_id' => 'a69aa50c01db4eb3347203761b1c4df17d0b5e43546b203250c59e005a8717756bd6fe5cdf9ebace',
                'revoked' => 0,
                'expires_at' => '2020-09-17 20:39:11',
            ),
            4 => 
            array (
                'id' => '40177767ca9315887c152491eed66cbfbd97854f64f82de649cdb8c84e54e909245bc31e9b15d9d1',
                'access_token_id' => '2319681e2110e52665f39c32e7de39ae4b79a736ed31c3db78c090d6837cea1f02f08818336beab4',
                'revoked' => 0,
                'expires_at' => '2020-09-17 04:41:00',
            ),
            5 => 
            array (
                'id' => '41d249712aeab6a87b1bb61256ad2e89d573746d6379c345640179d02bd639dd90a60fef9fcc2174',
                'access_token_id' => 'a9300690e20fc1e701ec2c95e14157ca8e207d9fc33c1fd247830f36bd058eb87f631afdc8a9720a',
                'revoked' => 0,
                'expires_at' => '2020-09-17 05:37:34',
            ),
            6 => 
            array (
                'id' => '44f2df270315c82fbaeef185847ef4254ecad0fca0a093620371bc438fa5167e4a8c25d432a57400',
                'access_token_id' => 'a441edf9ec3706debaf7bb3c871f5fefe3eee5f4c65e834eac07ad53951c90cc85735b9ece0a8506',
                'revoked' => 0,
                'expires_at' => '2020-10-30 21:18:46',
            ),
            7 => 
            array (
                'id' => '464ef8126f2e9eceb29309672fd4798ba09a8d258e25228137338dcc122cb65b60dbd62082eddf9e',
                'access_token_id' => 'edf9fc7146de39f68fe092aaa2333506637f4e71ecef1512ccc72d8be46330fc8c59fb052688aa17',
                'revoked' => 0,
                'expires_at' => '2020-09-17 06:37:08',
            ),
            8 => 
            array (
                'id' => '46aafd03a6effd7ae86c38966d0e7b1e7b8648f6f5229f2deb184568627ec1124e0602a5db4a8f16',
                'access_token_id' => '28550e868ea681853a7f65f990f36dc05af5ec8b2dca68f65a77ce46f90e88fbc56d02060c3c3c76',
                'revoked' => 0,
                'expires_at' => '2020-10-30 21:21:47',
            ),
            9 => 
            array (
                'id' => '4ce980db438ae98d437fd0febe3154b5b724650d0618261d42a1692b8b162b3a05d74f73ab6ba6b4',
                'access_token_id' => 'f06d5a3a78f67a13754710ac000b2960ec95b0c6756c4edd3246e14462001dd3f8d78899c352feb9',
                'revoked' => 0,
                'expires_at' => '2020-10-28 21:36:54',
            ),
            10 => 
            array (
                'id' => '5d98fbd27484fd5571f621aa927ae8c64e0791891bf432124df680717954515a90b09af525a66a39',
                'access_token_id' => '6df3ed0effa3df0f44c82d942f6f8459d7ff2aa3fda12ee1ff4e10b42eb99bb0cb07a1b6ee017f32',
                'revoked' => 0,
                'expires_at' => '2020-09-03 05:52:10',
            ),
            11 => 
            array (
                'id' => '61e0b7e7a3065909b44247199c0cb0043a89f81171541350fe0fcb4a905c75b00abf83110dade33a',
                'access_token_id' => 'd308196919eca229e5e518ca2fa736d39c6000a5cdd8c17258434cb2317bb353dc9e7bc2e1e75231',
                'revoked' => 0,
                'expires_at' => '2020-10-17 07:12:19',
            ),
            12 => 
            array (
                'id' => '6227cabe74556126c4f5b59cdc275f1071245350f4601e2a770ce54af6f94bed9af9826de8ea44ae',
                'access_token_id' => '5976b150596be128484b7a771a52aa12d2260bf67ec371beca7e23401597fd012ade675d9b712d1f',
                'revoked' => 0,
                'expires_at' => '2020-10-30 21:22:04',
            ),
            13 => 
            array (
                'id' => '65af6acbd8f1e70c1a96a5b3172250a134102e74e9fd47d83182bf3062d42c5d6716314b5ab616c3',
                'access_token_id' => '57872654356bb36e73df9559c8b5c00c6773e5f964682a567ba79cfea8e93e30937d62de50a44897',
                'revoked' => 0,
                'expires_at' => '2020-09-03 05:02:40',
            ),
            14 => 
            array (
                'id' => '66c57c27dd08b406abbe9e237a03132782646f1e629a3c7f21135ab7099475cbcf47c209fc1d2bca',
                'access_token_id' => 'adcd9d57dbbfcb901338582e2f57ab6405ee983dca9242e6572d100c661098380ea9901e63961bf2',
                'revoked' => 0,
                'expires_at' => '2020-12-01 14:09:44',
            ),
            15 => 
            array (
                'id' => '6814bbc0be57a8bcfd86ff565711af0521c58e3827d3fc000321a27170bd48d2d4a053375ef2a2ad',
                'access_token_id' => 'e8d3d716a465f728c60105717d891743ffe4342375cd30f4e77f39d5c01c6e4d425e12f0547fe970',
                'revoked' => 0,
                'expires_at' => '2020-12-22 11:12:47',
            ),
            16 => 
            array (
                'id' => '720c4df6c6e6d97fd7fc0a46eed9164e9cd01265663678c1fecdb5f2b646bf24fb34a42235af1c95',
                'access_token_id' => '44f5e3a7122d5502300f47b68b880ddfe1af451f5945be9d5874f7db78489b0f9aa14b834d3f4a57',
                'revoked' => 0,
                'expires_at' => '2020-12-22 12:00:54',
            ),
            17 => 
            array (
                'id' => '79540ed530b265274f16903c1b30ab0933f2e7fbff851e3ebbcc2e3843fd61ea65820e1e5d3b39ec',
                'access_token_id' => '32ec5060297cd98aaef84849b107b8f665eb3d3035831417231e297036bb203efa052625a9516059',
                'revoked' => 0,
                'expires_at' => '2020-10-22 22:04:47',
            ),
            18 => 
            array (
                'id' => '80aca653f24b1c084aad5a493b1e362cd62144124b95423d7639bf5c8ae37939811f9e374f79f6de',
                'access_token_id' => '89a64afeb41d0cb4c7cf82bbe326f82bd6d347ef7ebc60ba4eb9ba85ca4aea02f829559833965954',
                'revoked' => 0,
                'expires_at' => '2020-10-30 21:08:48',
            ),
            19 => 
            array (
                'id' => '823f58b256e7df731f03101ac51501ffc972b1de38f327c615f5da8c8025537b9effd45494059c03',
                'access_token_id' => '187775a9e3770424cc9793c71e62e0038df1108baa6e473b7533f5f88fb03c7c5e18acf2a27dfd0e',
                'revoked' => 0,
                'expires_at' => '2020-09-17 20:44:38',
            ),
            20 => 
            array (
                'id' => '8cc1290c84c6a54514fdc1a2d917c5d9c66e65c70e14265cc7c0a74c24ed06054c0af98ea17ef7ce',
                'access_token_id' => '30c268f59a9c0911090263e2212da13e575c3c94ddf0f8f50201b0a667b24c9dda15d474d498aa23',
                'revoked' => 0,
                'expires_at' => '2020-09-17 06:41:25',
            ),
            21 => 
            array (
                'id' => '8f8b5da86f0e3abb991d986c09a6d6b652820538b26bc6175207262bcd0eb3dc6a3ec83c577a4c9d',
                'access_token_id' => 'b83937515ab71c0ebb3ea01e833561aa6b85e61138eef2ef4f835bade070029ee318e852be94314e',
                'revoked' => 0,
                'expires_at' => '2020-09-17 05:40:11',
            ),
            22 => 
            array (
                'id' => '92a4745a770a86ddb3aadab616471a11b94b816577becbd08eafce769c16d231357ba56b582376c2',
                'access_token_id' => 'cf773628aaf8a6df50e72b8a06dd931818bc4eb831223aa07d924cc4dce485ac66b59cdc60b675a7',
                'revoked' => 0,
                'expires_at' => '2020-10-30 21:24:45',
            ),
            23 => 
            array (
                'id' => '93b8fc2976839aaddc89b45265437405c7398421541b69ed2aeb92f872d1fb54f6c1347490671185',
                'access_token_id' => '47561d62dab0513cc2c0ddf53799d554453c16170ae67f44c5782080cd78fa28e1d9af11e5ebf71f',
                'revoked' => 0,
                'expires_at' => '2020-09-17 05:34:26',
            ),
            24 => 
            array (
                'id' => '9543cb0ba3bbc9b97bb6898cc4998ef899f9dac86952659228a3bde91b284feb7f1736e278b0dc1c',
                'access_token_id' => '39e808bba26169493fa577adf4d256cc1a221f5c9ca385444da3213361efddd12e9f92c45f1bfcd0',
                'revoked' => 0,
                'expires_at' => '2020-09-17 20:36:58',
            ),
            25 => 
            array (
                'id' => '990fc3e8f2dd770eeea8a71f79642715db7e474e7663ecd377e7c1f4c76e049f68e923a074c5f564',
                'access_token_id' => '8c21443f72c1f3053fb6822ac269414d2b63e2b12c0a24605b134539532d9f85fae4531ad0c4d31a',
                'revoked' => 0,
                'expires_at' => '2021-01-23 21:35:30',
            ),
            26 => 
            array (
                'id' => '9cc1cb3fd7764d1ab41de3470687fe4d50b90937a97b61899967d38271a98c97f5a26fea8e9afa5b',
                'access_token_id' => '17e8711ae3ca0d23ebfcfc4a37e98db908e1e7d35f115214edbeb04447fc1ef7e411925c7438c2bc',
                'revoked' => 0,
                'expires_at' => '2020-09-13 07:06:48',
            ),
            27 => 
            array (
                'id' => '9d7fd7d42f56f9342a7d1dae3bf97aa751a4900ce023cb1ffe0015ac68587fe49496d0a1bf0de7f1',
                'access_token_id' => '2fea4bd966a5da26cc3ddc23f83b34fe387c449d17c12155ba91ef5dc79fd4bd779d0895bd5b67fe',
                'revoked' => 0,
                'expires_at' => '2020-09-03 06:01:33',
            ),
            28 => 
            array (
                'id' => 'a8e91b04a0c0f85291c331d8834af65a6e3da88131030622f29e361544ffd28642e2caabc54ac6b6',
                'access_token_id' => 'dbef664a975b682c8fa2c6bbf6778cd573579194d2213fecf5fb37c1ae7b1530f9b04c791614a616',
                'revoked' => 0,
                'expires_at' => '2020-10-30 21:06:32',
            ),
            29 => 
            array (
                'id' => 'b49644d090ab76eddb8e4270ad8302eff2af56041840ce20315e820c183ab2735507d45b8a8e4482',
                'access_token_id' => 'bfb8c6aaf82da110d3e124ab55e73d9ac16e4dec16bf654d7c3513b250462bb90eb35888130e6f4d',
                'revoked' => 0,
                'expires_at' => '2020-10-30 21:06:06',
            ),
            30 => 
            array (
                'id' => 'b9e2f8230b54367c8efb1fa6a1724263242b1317abfad49556edf395e1fd94c50eb241cba3625646',
                'access_token_id' => '24faeaa1c91bdd6e8db502d6cf9422f1990d1abed9061c69f2ee62ca7f526743d5ee0db232466bf2',
                'revoked' => 0,
                'expires_at' => '2020-10-29 20:41:28',
            ),
            31 => 
            array (
                'id' => 'bf5cf4aa6d056a7e5348b497b3bc4b118b8f5fcaf04afc251f7eaaff8adb3d11efc6232fb3607fb4',
                'access_token_id' => '72073e6ec04eb00d9cd5146ddcbccf671e2dbcf781082a6be9d56203b4a8eca1acda8ef3a06eaaac',
                'revoked' => 0,
                'expires_at' => '2020-09-17 20:45:03',
            ),
            32 => 
            array (
                'id' => 'cc91b987e09fe8985d4f3cb395fd3aeed4ba505adb07e838b445539b47b15a2ef99acf0a2bdc6e34',
                'access_token_id' => '8fc23e6cb75a2220b5c0cd7e90acae6a9b75b65e5c71fdb2931a279cca4a94d83325ea95bd178dd7',
                'revoked' => 0,
                'expires_at' => '2020-09-03 20:39:28',
            ),
            33 => 
            array (
                'id' => 'd4f447f7329475818f74303ac0933c03972e89fa68e15768f05d82db71825b82fde346f782755727',
                'access_token_id' => 'f7517817f5b7eb5d4642133ff3d9b61b642ee0266dd900cdc1e35c2ec95656131f0a984eea2b9206',
                'revoked' => 0,
                'expires_at' => '2020-12-22 11:14:25',
            ),
            34 => 
            array (
                'id' => 'e68433e62d719dff69a68c421edbedf007eda0142c7053b78ad7b02b6aa680e396acf89353924ad1',
                'access_token_id' => '8ea39fc7b0229681892b41d406e62ac4b3657baaec0f19baf334c90637a549e0734d064dbdd75884',
                'revoked' => 0,
                'expires_at' => '2020-09-17 20:10:26',
            ),
            35 => 
            array (
                'id' => 'ecd61a3ea1a5b0f118f44ce70437e249f817720c695ad193825f67ae58ebbacfbcf02fb34a2dfd39',
                'access_token_id' => '82618dc4445e0025c0b0578b7b43c822d52b7c6a80ebe681eff653b832d5c38fdba00167bc7f7d92',
                'revoked' => 0,
                'expires_at' => '2020-10-30 22:21:10',
            ),
        ));
        
        
    }
}