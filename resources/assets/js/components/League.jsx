import React from "react";

export default class League extends React.Component {
	getNameFromRange(count, size){
		//size *= 2;
		if(size <= 36) {
			size = 36;
		} else if(size <= 72) {
			size = 72;
		} else {
			size = 288;
		}

		var name;
		if( count > 4999 )
			name = 'R2zmhyqQ0_lKcDR5EyghXCxgyC9mm_mVMIjAbmGoZtw';
		else if( count > 4699 )
			name = 'qVCZmeYH0lS7Gaa6YoB7LrNly7bfw7fV_d4Vp2CU-gk';
		else if( count > 4399 )
			name = 'llpWocHlOoFliwyaEx5Z6dmoZG4u4NmxwpF-Jg7su7Q';
		else if( count > 4099 )
			name = 'L-HrwYpFbDwWjdmhJQiZiTRa_zXPPOgUTdmbsaq4meo';
		else if( count > 3799 )
			name = '9v_04LHmd1LWq7IoY45dAdGhrBkrc2ZFMZVhe23PdCE';
		else if( count > 3499 )
			name = 'kLWSSyq7vJiRiCantiKCoFuSJOxief6R1ky6AyfB8q0';
		else if( count > 3199 )
			name = 'JmmTbspV86xBigM7OP5_SjsEDPuE7oXjZC9aOy8xO3s';
		else if( count > 2999 )
			name = 'olUfFb1wscIH8hqECAdWbdB6jPm9R8zzEyHIzyBgRXc';
		else if( count > 2799 )
			name = '4wtS1stWZQ-1VJ5HaCuDPfdhTWjeZs_jPar_YPzK6Lg';
		else if( count > 2599 )
			name = 'pSXfKvBKSgtvfOY3xKkgFaRQi0WcE28s3X35ywbIluY';
		else if( count > 2399 )
			name = 'kSfTyNNVSvogX3dMvpFUTt72VW74w6vEsEFuuOV4osQ';
		else if( count > 2199 )
			name = 'jhP36EhAA9n1ADafdQtCP-ztEAQjoRpY7cT8sU7SW8A';
		else if( count > 1999 )
			name = 'Hyqco7bHh0Q81xB8mSF_ZhjKnKcTmJ9QEq9QGlsxiKE';
		else if( count > 1799 )
			name = 'CorhMY9ZmQvqXTZ4VYVuUgPNGSHsO0cEXEL5WYRmB2Y';
		else if( count > 1599 )
			name = 'Y6CveuHmPM_oiOic2Yet0rYL9AFRYW0WA0u2e44-YbM';
		else if( count > 1399 )
			name = 'vd4Lhz5b2I1P0cLH25B6q63JN3Wt1j2NTMhOYpMPQ4M';
		else if( count > 1199 )
			name = 'nvrBLvCK10elRHmD1g9w5UU1flDRMhYAojMB2UbYfPs';
		else if( count > 999 )
			name = '8OhXcwDJkenBH2kPH73eXftFOpHHRF-b32n0yrTqC44';
		else if( count > 799 )
			name = 'QcFBfoArnafaXCnB5OfI7vESpQEBuvWtzOyLq8gJzVc';
		else if( count > 599 )
			name = 'SZIXZHZxfHTmgseKCH6T5hvMQ3JQM-Js2QfpC9A3ya0';
		else if( count > 499 )
			name = 'U2acNDRaR5rQDu4Z6pQKaGcjWm9dkSnHMAPZCXrHPB4';
		else if( count > 399 )
			name = 'uUJDLEdAh7Lwf6YOHmXfNM586ZlEvMju54bTlt2u6EE';
		else
			name = 'e--YMyIexEQQhE4imLoJcwhYn6Uy8KqlgyY3_kFV6t4';
		return 'https://clash.cloud/asset/image/league/' + name + '/' + size + '.png';
	}

	render(){
		var count = this.props.trophies;

		// Set 0 if not in league
		if(this.props.state == 0)
			count = 0;
		return(
				<div><img width={this.props.size} src={this.getNameFromRange(count, this.props.size)}/></div>
		);
	}
}